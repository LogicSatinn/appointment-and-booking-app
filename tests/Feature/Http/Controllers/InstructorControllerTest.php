<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InstructorController
 */
class InstructorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $instructors = Instructor::factory()->count(3)->create();

        $response = $this->get(route('instructor.index'));

        $response->assertOk();
        $response->assertViewIs('instructor.index');
        $response->assertViewHas('instructors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('instructor.create'));

        $response->assertOk();
        $response->assertViewIs('instructor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InstructorController::class,
            'store',
            \App\Http\Requests\InstructorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone_number = $this->faker->phoneNumber;
        $password = $this->faker->password;
        $email_verified_at = $this->faker->word;
        $banned_at = $this->faker->dateTime();

        $response = $this->post(route('instructor.store'), [
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => $password,
            'email_verified_at' => $email_verified_at,
            'banned_at' => $banned_at,
        ]);

        $instructors = Instructor::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('phone_number', $phone_number)
            ->where('password', $password)
            ->where('email_verified_at', $email_verified_at)
            ->where('banned_at', $banned_at)
            ->get();
        $this->assertCount(1, $instructors);
        $instructor = $instructors->first();

        $response->assertRedirect(route('instructor.index'));
        $response->assertSessionHas('instructor.id', $instructor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $instructor = Instructor::factory()->create();

        $response = $this->get(route('instructor.show', $instructor));

        $response->assertOk();
        $response->assertViewIs('instructor.show');
        $response->assertViewHas('instructor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $instructor = Instructor::factory()->create();

        $response = $this->get(route('instructor.edit', $instructor));

        $response->assertOk();
        $response->assertViewIs('instructor.edit');
        $response->assertViewHas('instructor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InstructorController::class,
            'update',
            \App\Http\Requests\InstructorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $instructor = Instructor::factory()->create();
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone_number = $this->faker->phoneNumber;
        $password = $this->faker->password;
        $email_verified_at = $this->faker->word;
        $banned_at = $this->faker->dateTime();

        $response = $this->put(route('instructor.update', $instructor), [
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => $password,
            'email_verified_at' => $email_verified_at,
            'banned_at' => $banned_at,
        ]);

        $instructor->refresh();

        $response->assertRedirect(route('instructor.index'));
        $response->assertSessionHas('instructor.id', $instructor->id);

        $this->assertEquals($name, $instructor->name);
        $this->assertEquals($email, $instructor->email);
        $this->assertEquals($phone_number, $instructor->phone_number);
        $this->assertEquals($password, $instructor->password);
        $this->assertEquals($email_verified_at, $instructor->email_verified_at);
        $this->assertEquals($banned_at, $instructor->banned_at);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $instructor = Instructor::factory()->create();

        $response = $this->delete(route('instructor.destroy', $instructor));

        $response->assertRedirect(route('instructor.index'));

        $this->assertSoftDeleted($instructor);
    }
}
