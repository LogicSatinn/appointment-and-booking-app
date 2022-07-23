@section('title', 'Congratulations')

<x-client.master-layout class="woocommerce-order-received">
    <!-- SHOP ORDER COMPLETED
================================================== -->
    <div class="container py-8 py-lg-11">
        <div class="row">
            <div class="col-xl-8 mx-xl-auto">
                <header class="entry-header">
                    @if(request()->routeIs('reservation-complete'))
                        <h1 class="entry-title">Reservation Complete</h1>
                    @else
                        <h1 class="entry-title">Booking Complete</h1>
                    @endif
                </header>

                <div class="entry-content">
                    <div class="woocommerce">
                        <div class="woocommerce-order">
                            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                                We thank you for your business.</p>

                            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                                <li class="woocommerce-order-overview__order order">
                                    Booking Reference:
                                    <strong>{{ $booking->reference_code }}</strong>
                                </li>

                                <li class="woocommerce-order-overview__date date">
                                    Date:
                                    <strong>{{ $booking->booked_at }}</strong>
                                </li>

                                <li class="woocommerce-order-overview__total total">
                                    Total:
                                    <strong><span class="woocommerce-Price-amount amount"><span
                                                class="woocommerce-Price-currencySymbol">TZS</span>{{ $booking->total_amount }}</span></strong>
                                </li>

                                <li class="woocommerce-order-overview__payment-method method">
                                    Booking Method:
                                    <strong>{{ $booking->booking_method->value }}</strong>
                                </li>
                            </ul>

                            <section class="woocommerce-order-details">
                                <h2 class="woocommerce-order-details__title">Order details</h2>
                                <table
                                    class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                    <thead>
                                    <tr>
                                        <th class="woocommerce-table__product-name product-name"></th>
                                        <th class="woocommerce-table__product-table product-total">Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="woocommerce-table__line-item order_item">
                                        <td class="woocommerce-table__product-name product-name">
                                            <a href="#">Seats ( @ {{ $timetable->representablePrice }} )</a>
                                            <strong
                                                class="product-quantity">× {{ $clientTimetable->pivot->no_of_seats }}</strong>
                                        </td>

                                        <td class="woocommerce-table__product-total product-total">
                                            <span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol"> </span>{{ $timetable->price * $clientTimetable->pivot->no_of_seats }}</span>
                                        </td>
                                    </tr>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th scope="row">Sub-Total:</th>
                                        <td><span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol">TZS </span>{{ $booking->total_amount }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payment method:</th>
                                        <td>Check payments</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total:</th>
                                        <td><span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol">TZS </span>{{ $booking->total_amount }}</span>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </section>

                            <section class="woocommerce-customer-details">
                                <h2 class="woocommerce-column__title">Billing Address</h2>
                                <address>
                                    {{ $clientTimetable->address ?? 'Not Provided' }}
                                </address>
                            </section>

                            <div class="form-row place-order pt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary btn-block">
                                    I'm done here. Take me Home.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client.master-layout>
