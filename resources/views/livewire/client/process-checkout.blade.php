<div x-data="{ openModal: @entangle('launchModal') }">
    <div id="order_review" class="woocommerce-checkout-review-order mt-3">
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
                        Seats ( @ {{$timetable->representablePrice() }} )
                        <strong class="product-quantity">× {{ $reservation->no_of_seats }}</strong>
                    </td>
                    <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">TZS</span>&nbsp;
                                        {{ number_format($this->total) }}
                                    </span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="cart-subtotal">
                    <th>Sub-Total</th>
                    <td><span class="woocommerce-Price-amount amount"><span
                                class="woocommerce-Price-currencySymbol">TZS </span> {{ number_format($this->total) }}</span>
                    </td>
                </tr>

                <tr class="order-total">
                    <th>Total</th>
                    <td><strong><span class="woocommerce-Price-amount amount"><span
                                    class="woocommerce-Price-currencySymbol">TZS </span> {{ number_format($this->total) }}</span></strong>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

        <h5 id="order_review_heading">How do you want to do this?</h5>
        <div id="payment" class="woocommerce-checkout-payment">
            <ul class="wc_payment_methods payment_methods methods">
                <li class="wc_payment_method">
                    <input id="direct_payment" type="radio" class="input-radio" wire:model="method"
                           value="{{ 'Direct Payment' }}" data-order_button_text="">

                    <label for="direct_payment">Direct Payment </label>
                    <div class="payment_box">
                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment
                            reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                    </div>
                </li>


                <li class="wc_payment_method">
                    <input id="reservation" type="radio" class="input-radio" wire:model="method"
                           value="{{ 'Reservation' }}" data-order_button_text="">

                    <label for="reservation">Reserve Seat </label>
                    <div class="payment_box col-12">
                        <p>Reserve a seat, and you'll pay directly when you arrive for the timetable.</p>
                    </div>
                </li>

            </ul>
            <div class="form-row place-order pt-4">
                <button wire:click="processCheckout" class="btn btn-primary btn-block">
                    Complete Checkout
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" x-show="openModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <!-- Close -->
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                    <h2 class="fw-bold text-center mb-1" id="modalExampleTitle">
                        We're handling the payment details for you ...
                    </h2>

                    <p class="font-size-lg text-center text-muted mb-6 mb-md-8">
                        You will receive a pop-up asking to finalize the transaction, please confirm the transaction, and we will notify you as soon as the transaction is confirmed on our end. Thank you for doing business with us.
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-block btn-primary mt-3 lift" type="button" wire:click="proceed">
                                Request a demo
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
