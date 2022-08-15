<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaymentController
 */
class PaymentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $payments = Payment::factory()->count(3)->create();

        $response = $this->get(route('payment.index'));

        $response->assertOk();
        $response->assertViewIs('payment.index');
        $response->assertViewHas('payments');
    }

    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('payment.create'));

        $response->assertOk();
        $response->assertViewIs('payment.create');
    }

    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'store',
            \App\Http\Requests\PaymentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $payment_method = $this->faker->word;
        $paid_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $due_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $status = $this->faker->word;
        $booking = Booking::factory()->create();
        $reference_code = $this->faker->word;

        $response = $this->post(route('payment.store'), [
            'payment_method' => $payment_method,
            'paid_amount' => $paid_amount,
            'total_amount' => $total_amount,
            'due_amount' => $due_amount,
            'status' => $status,
            'booking_id' => $booking->id,
            'reference_code' => $reference_code,
        ]);

        $payments = Payment::query()
            ->where('payment_method', $payment_method)
            ->where('paid_amount', $paid_amount)
            ->where('total_amount', $total_amount)
            ->where('due_amount', $due_amount)
            ->where('status', $status)
            ->where('booking_id', $booking->id)
            ->where('reference_code', $reference_code)
            ->get();
        $this->assertCount(1, $payments);
        $payment = $payments->first();

        $response->assertRedirect(route('payment.index'));
        $response->assertSessionHas('payment.id', $payment->id);
    }

    /**
     * @test
     */
    public function show_displays_view()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payment.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.show');
        $response->assertViewHas('payment');
    }

    /**
     * @test
     */
    public function edit_displays_view()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('payment.edit', $payment));

        $response->assertOk();
        $response->assertViewIs('payment.edit');
        $response->assertViewHas('payment');
    }

    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaymentController::class,
            'update',
            \App\Http\Requests\PaymentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $payment = Payment::factory()->create();
        $payment_method = $this->faker->word;
        $paid_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $due_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $status = $this->faker->word;
        $booking = Booking::factory()->create();
        $reference_code = $this->faker->word;

        $response = $this->put(route('payment.update', $payment), [
            'payment_method' => $payment_method,
            'paid_amount' => $paid_amount,
            'total_amount' => $total_amount,
            'due_amount' => $due_amount,
            'status' => $status,
            'booking_id' => $booking->id,
            'reference_code' => $reference_code,
        ]);

        $payment->refresh();

        $response->assertRedirect(route('payment.index'));
        $response->assertSessionHas('payment.id', $payment->id);

        $this->assertEquals($payment_method, $payment->payment_method);
        $this->assertEquals($paid_amount, $payment->paid_amount);
        $this->assertEquals($total_amount, $payment->total_amount);
        $this->assertEquals($due_amount, $payment->due_amount);
        $this->assertEquals($status, $payment->status);
        $this->assertEquals($booking->id, $payment->booking_id);
        $this->assertEquals($reference_code, $payment->reference_code);
    }

    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $payment = Payment::factory()->create();

        $response = $this->delete(route('payment.destroy', $payment));

        $response->assertRedirect(route('payment.index'));

        $this->assertSoftDeleted($payment);
    }
}
