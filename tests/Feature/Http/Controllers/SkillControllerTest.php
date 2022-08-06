<?php

namespace Tests\Feature\Http\Controllers;

use App\Enums\SkillLevel;
use App\Enums\SkillStatus;
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
        $skills = Skill::factory()->count(3)->create();

        $response = $this->get(route('skill.index'));

        $response->assertOk();
        $response->assertViewIs('skill.index');
        $response->assertViewHas('skills');
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
        $slug = $title;
        $description = $this->faker->text;
        $modeOfDelivery = $this->faker->text;
        $prerequisite = $this->faker->text;
        $suitableFor = $this->faker->text;
        $level = $this->faker->randomElement([
            SkillLevel::BEGINNER,
            SkillLevel::INTERMEDIATE,
            SkillLevel::ADVANCED,
        ]);
        $status = $this->faker->randomElement([
            SkillStatus::DRAFT,
            SkillStatus::ARCHIVED,
            SkillStatus::PUBLISHED,
        ]);
        $category = Category::factory()->create();

        $response = $this->post(route('skill.store'), [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'mode_of_delivery' => $modeOfDelivery,
            'prerequisite' => $prerequisite,
            'suitable_for' => $suitableFor,
            'level' => $level,
            'status' => $status,
            'category_id' => $category->id,
        ]);

        $skills = Skill::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('mode_of_delivery', $modeOfDelivery)
            ->where('prerequisite', $prerequisite)
            ->where('suitable_for', $suitableFor)
            ->where('level', $level)
            ->where('status', $status)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $skills);
        $skill = $skills->first();

        $response->assertRedirect(route('skill.index'));
        $response->assertSessionHas('skill.id', $skill->id);
    }

    /**
     * @test
     */
    public function show_displays_view()
    {
        $skill = Skill::factory()->create();

        $response = $this->get(route('skill.show', $skill));

        $response->assertOk();
        $response->assertViewIs('skill.show');
        $response->assertViewHas('skill');
    }

    /**
     * @test
     */
    public function edit_displays_view()
    {
        $skill = Skill::factory()->create();

        $response = $this->get(route('skill.edit', $skill));

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
        $skill = Skill::factory()->create();
        $title = $this->faker->sentence(4);
        $slug = $title;
        $description = $this->faker->text;
        $modeOfDelivery = $this->faker->text;
        $prerequisite = $this->faker->text;
        $suitableFor = $this->faker->text;
        $level = $this->faker->randomElement([
            SkillLevel::BEGINNER,
            SkillLevel::INTERMEDIATE,
            SkillLevel::ADVANCED,
        ]);
        $status = $this->faker->randomElement([
            SkillStatus::DRAFT,
            SkillStatus::ARCHIVED,
            SkillStatus::PUBLISHED,
        ]);
        $category = Category::factory()->create();

        $response = $this->put(route('skill.update', $skill), [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'mode_of_delivery' => $modeOfDelivery,
            'prerequisite' => $prerequisite,
            'suitable_for' => $suitableFor,
            'level' => $level,
            'status' => $status,
            'category_id' => $category->id,
        ]);

        $skill->refresh();

        $response->assertRedirect(route('skill.index'));
        $response->assertSessionHas('skill.id', $skill->id);

        $this->assertEquals($title, $skill->title);
        $this->assertEquals($slug, $skill->slug);
        $this->assertEquals($description, $skill->description);
        $this->assertEquals($modeOfDelivery, $skill->mode_of_delivery);
        $this->assertEquals($prerequisite, $skill->prerequisite);
        $this->assertEquals($suitableFor, $skill->suitable_for);
        $this->assertEquals($level, $skill->level);
        $this->assertEquals($status, $skill->status);
        $this->assertEquals($category->id, $skill->category_id);
    }

    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $skill = Skill::factory()->create();

        $response = $this->delete(route('skill.destroy', $skill));

        $response->assertRedirect(route('skill.index'));

        $this->assertSoftDeleted($skill);
    }
}
