@section('title', 'Checkout')

<x-client.master-layout>

    <!-- PAGE TITLE
    ================================================== -->
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Checkout
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>


    <!-- SHOP CHECKOUT
    ================================================== -->
    <div class="container pb-6 pb-xl-10">
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="https://transvelo.github.io/skola-html/5.1/..." novalidate="">
            <div class="col2-set" id="customer_details">
                <div class="col-1">
                    <div class="woocommerce-billing-fields">
                        <div id="accordionCurriculum">
                            <x-client.checkout-accordion-holder>
                                <x-slot:accordion-title>
                                    Client Details
                                </x-slot:accordion-title>

                                <x-slot:column>
                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Name
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $client->name }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column class="bg-gray-100">
                                        <x-slot:column-name>
                                            Email
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $client->email }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Phone Number
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $client->phone_number }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>
                                </x-slot:column>
                            </x-client.checkout-accordion-holder>

                            <x-client.checkout-accordion-holder>
                                <x-slot:accordion-title>
                                    Appointment Details
                                </x-slot:accordion-title>

                                <x-slot:column>
                                    <x-client.checkout-accordion-column class="bg-gray-100">
                                        <x-slot:column-name>
                                            Skill Title
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->skill->title }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Appointment Title
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->title }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column class="bg-gray-100">
                                        <x-slot:column-name>
                                            Duration
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->duration }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Start Data
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->from }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column class="bg-gray-100">
                                        <x-slot:column-name>
                                            End Date
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->to }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Hours ( 24-Hour Format)
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $appointment->start }} - {{ $appointment->end }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>
                                </x-slot:column>
                            </x-client.checkout-accordion-holder>

                            <x-client.checkout-accordion-holder>
                                <x-slot:accordion-title>
                                    Additional Information
                                </x-slot:accordion-title>

                                <x-slot:column>
                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Client's Profession
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $client->profession ?? 'Not provided' }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>

                                    <x-client.checkout-accordion-column>
                                        <x-slot:column-name>
                                            Client's Address
                                        </x-slot:column-name>

                                        <x-slot:column-data>
                                            {{ $client->address ?? 'Not Provided' }}
                                        </x-slot:column-data>
                                    </x-client.checkout-accordion-column>
                                </x-slot:column>
                            </x-client.checkout-accordion-holder>
                        </div>
                    </div>
                </div>

            </div>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <div class="woocommerce-checkout-review-order-inner">
                    <h3 id="order_review_heading">Your order</h3>
                    <table class="shop_table woocommerce-checkout-review-order-table">
                        <thead>
                        <tr>
                            <th class="product-name"></th>
                            <th class="product-total">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="cart_item">
                            <td class="product-name">
                                Seats
                                <strong class="product-quantity">× {{ $clientAppointment->pivot->no_of_seats }}</strong>
                            </td>
                            <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">TZS</span>&nbsp;
                                        {{ number_format($clientAppointment->pivot->no_of_seats * $appointment->price) }}
                                    </span>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="cart-subtotal">
                            <th>Sub-Total</th>
                            <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS </span> {{ number_format($clientAppointment->pivot->no_of_seats * $appointment->price) }}</span></td>
                        </tr>

                        <tr class="order-total">
                            <th>Total</th>
                            <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS </span> {{ number_format($clientAppointment->pivot->no_of_seats * $appointment->price) }}</span></strong> </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div id="payment" class="woocommerce-checkout-payment">
                    <ul class="wc_payment_methods payment_methods methods">
                        <li class="wc_payment_method payment_method_bacs">
                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="bacs" data-order_button_text="">

                            <label for="payment_method_bacs">Direct bank transfer </label>
                            <div class="payment_box payment_method_bacs" style="display: block;">
                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_cheque">
                            <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" data-order_button_text="">

                            <label for="payment_method_cheque">Check payments </label>
                            <div class="payment_box payment_method_cheque d-none" style="display: block;">
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_cod">
                            <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked="checked" data-order_button_text="">

                            <label for="payment_method_cod">Cash on delivery </label>
                            <div class="payment_box payment_method_cod d-none" style="display: block;">
                                <p>Pay with cash upon delivery.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_paypal">
                            <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">

                            <label for="payment_method_paypal">PayPal
                                <img src="../../../www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" alt="PayPal acceptance mark">
                                <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal">What is PayPal?</a>
                            </label>

                            <div class="payment_box payment_method_paypal d-none" style="display: block;">
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                            </div>
                        </li>
                    </ul>
                    <div class="form-row place-order">
                        <a href="shop-order-completed.html" class="btn btn-primary btn-block">
                            PLACE ORDER
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-client.master-layout>
