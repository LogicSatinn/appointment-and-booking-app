@section('title', 'Cart')

<div>
    <!-- PAGE TITLE
 ================================================== -->
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Cart
                    </li>
                </ol>
            </nav>
        </div>
    </header>


    <!-- SHOP CART
        ================================================== -->
    <div class="container pb-6 pb-xl-10">
        <div class="row">
            <div id="primary" class="content-area">
                <main id="main" class="site-main ">
                    <div class="page type-page status-publish hentry">
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Title</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Seats</th>
                                        <th class="product-subtotal">Sub-Total</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                        <td class="product-name" data-title="Product">
                                            <div class="d-flex align-items-center">
                                                <div class="ms-6">
                                                    {{ $timetable->title }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="product-price" data-title="Price">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{ $timetable->representablePrice() }}</span>
                                        </td>

                                        <td class="product-quantity" data-title="Quantity">
                                            <!-- Quantity -->
                                            <div class="border rounded d-flex align-items-center">
                                                <input class="form-control form-control-sm border-0 quantity mw-70p px-2" min="1" wire:model="seat" value="{{ $seat }}" type="text">
                                                <div class="d-flex flex-column me-3">
                                                    <button wire:click="addSeat" class="border-0 shadow-none quantity-plus font-size-10 p-0 bg-transparent outline-0 text-dark">
                                                        <i class="fas fa-chevron-up"></i>
                                                    </button>
                                                    <button wire:click="subtractSeat" class="border-0 shadow-none quantity-minus font-size-10 p-0 bg-transparent outline-0 text-dark">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- End Quantity -->
                                        </td>

                                        <td class="product-subtotal" data-title="Total">
                                            <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS</span> {{ number_format($subTotal) }}</span>
                                        </td>
                                        <td class="product-remove">
                                            <a href="#" class="remove" aria-label="Remove this item">
                                                <i class="far fa-trash-alt text-secondary font-size-sm"></i>
                                            </a>
                                        </td>
                                    </tr>


{{--                                    <tr>--}}
{{--                                        <td colspan="5" class="actions">--}}
{{--                                            <div class="coupon">--}}
{{--                                                <label for="coupon_code">Coupon:</label>--}}
{{--                                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code" autocomplete="off"> <input type="submit" class="button" name="apply_coupon" value="Apply coupon">--}}
{{--                                            </div>--}}

{{--                                            <input type="submit" class="button" name="update_cart" value="Update cart">--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </div>
                </main>
            </div>
            <div id="secondary" class="sidebar" role="complementary">
                <div class="cart-collaterals">
                    <div class="cart_totals">
                        <h2>Cart Total</h2>

                        <table class="shop_table shop_table_responsive">
                            <tbody>
                            <tr class="cart-subtotal">
                                <th>Sub-Total</th>
                                <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS</span> {{ number_format($subTotal) }}</span></td>
                            </tr>

                            <tr class="cart-subtotal">
                                <th>Discount</th>
                                <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS</span> {{ number_format($discount) }}</span></td>
                            </tr>

                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">TZS</span> {{ number_format($total) }}</span></strong> </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="wc-proceed-to-checkout">
                            <button wire:click="saveCart" class="checkout-button button alt wc-forward">
                                Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

