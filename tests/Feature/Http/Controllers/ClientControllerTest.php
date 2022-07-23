<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ClientController;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientController
 */
class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $clients = Client::factory()->count(3)->create();

        $response = $this->get(route('client.index'));

        $response->assertOk();
        $response->assertViewIs('client.index');
        $response->assertViewHas('clients');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('client.create'));

        $response->assertOk();
        $response->assertViewIs('client.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            ClientController::class,
            'store',
            \App\Http\Requests\ClientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $profession = $this->faker->word;
        $phoneNumber = $this->faker->phoneNumber;
        $address = $this->faker->address;

        $response = $this->post(route('client.store'), [
            'name' => $name,
            'email' => $email,
            'profession' => $profession,
            'address' => $address,
            'phone_number' => $phoneNumber,
        ]);

        $clients = Client::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('phone_number', $phoneNumber)
            ->where('profession', $profession)
            ->where('address', $address)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertRedirect(route('client.index'));
        $response->assertSessionHas('client.id', $client->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('client.show', $client));

        $response->assertOk();
        $response->assertViewIs('client.show');
        $response->assertViewHas('client');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('client.edit', $client));

        $response->assertOk();
        $response->assertViewIs('client.edit');
        $response->assertViewHas('client');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            ClientController::class,
            'update',
            ClientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $client = Client::factory()->create();
        $name = $this->faker->name;
        $email = $this->faker->email;
        $profession = $this->faker->word;
        $phoneNumber = $this->faker->phoneNumber;
        $address = $this->faker->address;

        $response = $this->put(route('client.update', $client), [
            'name' => $name,
            'email' => $email,
            'profession' => $profession,
            'address' => $address,
            'phone_number' => $phoneNumber,
        ]);

        $client->refresh();

        $response->assertRedirect(route('client.index'));
        $response->assertSessionHas('client.id', $client->id);

        $this->assertEquals($name, $client->name);
        $this->assertEquals($email, $client->email);
        $this->assertEquals($profession, $client->profession);
        $this->assertEquals($phoneNumber, $client->phone_number);
        $this->assertEquals($address, $client->address);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('client.destroy', $client));

        $response->assertRedirect(route('client.index'));

        $this->assertSoftDeleted($client);
    }
}
