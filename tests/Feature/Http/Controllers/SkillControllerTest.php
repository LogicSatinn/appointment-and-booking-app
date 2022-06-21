<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\SkillController;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SkillController
 */
class SkillControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $courses = Skill::factory()->count(3)->create();

        $response = $this->get(route('skill.index'));

        $response->assertOk();
        $response->assertViewIs('skill.index');
        $response->assertViewHas('courses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('skill.create'));

        $response->assertOk();
        $response->assertViewIs('skill.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            SkillController::class,
            'store',
            SkillStoreRequest::class
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

        $response = $this->post(route('skill.store'), [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category_id' => $category->id,
            'access' => $access,
        ]);

        $courses = Skill::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('price', $price)
            ->where('category_id', $category->id)
            ->where('access', $access)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertRedirect(route('skill.index'));
        $response->assertSessionHas('skill.id', $course->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $course = Skill::factory()->create();

        $response = $this->get(route('skill.show', $course));

        $response->assertOk();
        $response->assertViewIs('skill.show');
        $response->assertViewHas('skill');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $course = Skill::factory()->create();

        $response = $this->get(route('skill.edit', $course));

        $response->assertOk();
        $response->assertViewIs('skill.edit');
        $response->assertViewHas('skill');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            SkillController::class,
            'update',
            SkillUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $course = Skill::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $category = Category::factory()->create();
        $access = $this->faker->boolean;

        $response = $this->put(route('skill.update', $course), [
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'category_id' => $category->id,
            'access' => $access,
        ]);

        $course->refresh();

        $response->assertRedirect(route('skill.index'));
        $response->assertSessionHas('skill.id', $course->id);

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
        $course = Skill::factory()->create();

        $response = $this->delete(route('skill.destroy', $course));

        $response->assertRedirect(route('skill.index'));

        $this->assertSoftDeleted($course);
    }
}
