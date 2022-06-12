<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CourseController
 */
class CourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->get(route('course.index'));

        $response->assertOk();
        $response->assertViewIs('course.index');
        $response->assertViewHas('courses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('course.create'));

        $response->assertOk();
        $response->assertViewIs('course.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'store',
            \App\Http\Requests\CourseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $category = Category::factory()->create();
        $access = $this->faker->boolean;

        $response = $this->post(route('course.store'), [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category_id' => $category->id,
            'access' => $access,
        ]);

        $courses = Course::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('price', $price)
            ->where('category_id', $category->id)
            ->where('access', $access)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertRedirect(route('course.index'));
        $response->assertSessionHas('course.id', $course->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.show', $course));

        $response->assertOk();
        $response->assertViewIs('course.show');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.edit', $course));

        $response->assertOk();
        $response->assertViewIs('course.edit');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'update',
            \App\Http\Requests\CourseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $course = Course::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $category = Category::factory()->create();
        $access = $this->faker->boolean;

        $response = $this->put(route('course.update', $course), [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category_id' => $category->id,
            'access' => $access,
        ]);

        $course->refresh();

        $response->assertRedirect(route('course.index'));
        $response->assertSessionHas('course.id', $course->id);

        $this->assertEquals($title, $course->title);
        $this->assertEquals($description, $course->description);
        $this->assertEquals($price, $course->price);
        $this->assertEquals($category->id, $course->category_id);
        $this->assertEquals($access, $course->access);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('course.destroy', $course));

        $response->assertRedirect(route('course.index'));

        $this->assertSoftDeleted($course);
    }
}
