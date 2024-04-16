<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    @if ($cartItems->isEmpty())
        <div class="container mt-150 mb-150">
            <p>No items in the cart</p>
        </div>
    @else
        <div class="cart-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-table-wrap">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Product Image</th>
                                        <th class="product-name">Name</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        <tr id="cartItem{{ $cartItem->id }}" class="table-body-row">
                                            <td class="product-remove">
                                                <button class="btn form-button bg-danger deleteCartItem"
                                                    data-id="{{ $cartItem->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="product-image">
                                                <img src="{{ asset('assets/' . $cartItem->coffee->image) }}"
                                                    alt="{{ $cartItem->coffee->name }}">
                                            </td>
                                            <td class="product-name">{{ $cartItem->coffee->name }}</td>
                                            <td class="product-price">${{ $cartItem->coffee->price }}</td>
                                            <td class="product-quantity">
                                                <div class="quantity-input">
                                                    <form action="{{ route('cart.update', $cartItem->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="btn btn-number decrease">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="number" name="quantity"
                                                            value="{{ $cartItem->quantity }}" min="1">
                                                        <button type="button" class="btn btn-number increase">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="warning-message">Minimum input is 1</div>
                                            </td>
                                            <td class="product-total">
                                                ${{ $cartItem->quantity * $cartItem->coffee->price }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="total-section mb-4">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Apply Coupon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td>
                                            <div class="coupon-section">
                                                <div class="coupon-form-wrap">
                                                    <form id="applyCouponForm" method="POST">
                                                        @csrf
                                                        <p>
                                                            <input type="text" name="coupon_code"
                                                                placeholder="Enter coupon code">
                                                        </p>
                                                        <button type="submit" class="form-button">Apply</button>
                                                    </form>
                                                </div>
                                                <span id="couponMessage"></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="checkout-accordion-wrap">
                            <div class="accordion" id="accordionExample">

                                <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
                                    <div class="card single-accordion">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Order Details
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="billing-address-form">
                                                    @csrf
                                                    <!-- Hidden input for cart items -->
                                                    @foreach ($cartItems as $cartItem)
                                                        <input type="hidden"
                                                            name="cartItems[{{ $loop->index }}][coffee_id]"
                                                            value="{{ $cartItem->coffee->id }}">
                                                        <input type="hidden"
                                                            name="cartItems[{{ $loop->index }}][quantity]"
                                                            value="{{ $cartItem->quantity }}">
                                                        <input type="hidden"
                                                            name="cartItems[{{ $loop->index }}][price]"
                                                            value="{{ $cartItem->coffee->price }}">
                                                    @endforeach
                                                    <input type="hidden" class="getSubTotalPrice"
                                                        name="getSubTotalPrice" id="getSubTotalPrice">
                                                    <input type="hidden" class="getCheckoutPrice"
                                                        name="getCheckoutPrice" id="getCheckoutPrice">
                                                    <input type="hidden" class="getDiscount" name="getDiscount"
                                                        id="getDiscount">
                                                    <p><input type="text" name="customer_name" placeholder="Name"
                                                            required></p>
                                                    <p><input type="tel" name="customer_phone"
                                                            placeholder="Phone" required></p>
                                                    <p>
                                                        <textarea name="bill" cols="30" rows="10" placeholder="Note"></textarea>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card single-accordion">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button"
                                                    data-toggle="collapse" data-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Card Details
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                            data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="billing-address-form">
                                                    <form action="/">
                                                        <p><input type="text" id="card_number" name="card_number"
                                                                placeholder="Enter your card number" required></p>
                                                        <p>
                                                            <input type="text" id="expiration_date"
                                                                name="expiration_date" placeholder="MM/YYYY" required>
                                                        </p>
                                                        <p>
                                                            <input type="text"id="cvv" name="cvv"
                                                                placeholder="Enter CVV" required>
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4">

                        <div class="total-section">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Total</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td class="subtotal-price">Subtotal value</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Discount: </strong></td>
                                        <td class="discount-price">0.00</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td class="total-price">Total value</td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" class="getCheckoutPrice" name="getCheckoutPrice"
                                id="getCheckoutPrice">
                            <input type="hidden" class="getDiscount" name="getDiscount" id="getDiscount">

                            <div class="cart-buttons">
                                <button id="checkoutButton" type="button" class="form-button">Checkout</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        </div>
    @endif

    <x-slot name="footer">
    </x-slot>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const quantityInputs = document.querySelectorAll('.product-quantity input[type="number"]');
        const deleteButtons = document.querySelectorAll('.deleteCartItem');
        const applyCouponForm = document.getElementById('applyCouponForm');
        const subtotalElement = document.querySelector('.subtotal-price');
        const discountElement = document.querySelector('.discount-price');
        const totalPriceElement = document.querySelector('.total-price');
        const couponMessageElement = document.getElementById('couponMessage');
        const getSubTotalPriceInput = document.getElementById('getSubTotalPrice');
        const getDiscountInput = document.getElementById('getDiscount');
        const getCheckoutPriceInput = document.getElementById('getCheckoutPrice');

        // Add click event listener to the checkout button
        document.getElementById('checkoutButton').addEventListener('click', function() {
            // Trigger form submission when the button is clicked
            document.getElementById('checkoutForm').submit();
        });

        function calculatePrices(data = null) {
            let subtotal = 0;
            if (data) {
                data.cartItems.forEach(cartItem => {
                    subtotal += cartItem.quantity * cartItem.coffee.price;
                });
            } else {
                quantityInputs.forEach(input => {
                    const tableRow = input.closest('.table-body-row');
                    const price = parseFloat(tableRow.querySelector('.product-price').textContent
                        .replace(
                            '$', ''));
                    const quantity = parseInt(input.value);
                    const productTotalPrice = price * quantity;
                    subtotal += productTotalPrice;
                    tableRow.querySelector('.product-total').textContent = '$' + productTotalPrice
                        .toFixed(
                            2);
                });
            }

            subtotalElement.textContent = '$' + subtotal.toFixed(2);
            const discount = parseFloat(discountElement.textContent.replace('$', ''));
            const total = subtotal - discount;
            totalPriceElement.textContent = '$' + total.toFixed(2);
        }

        function showCouponMessage(type, message) {
            couponMessageElement.textContent = message;
            couponMessageElement.classList.remove('text-success', 'text-danger', 'text-info');
            couponMessageElement.classList.add(`text-${type}`);
        }

        // Function to update quantity
        function updateQuantity(input, operation) {
            const currentValue = parseInt(input.value);
            if ((operation === 'increment' && currentValue < 999) || (operation === 'decrement' &&
                    currentValue > 1)) {
                input.value = operation === 'increment' ? currentValue + 1 : currentValue - 1;
            }

            const formData = new FormData(input.closest('form'));
            fetch(input.closest('form').action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.subtotal !== undefined) {
                        subtotalElement.textContent = '$' + data.subtotal.toFixed(2);
                    }
                    if (data.discount !== undefined) {
                        discountElement.textContent = '$' + data.discount.toFixed(2);
                    }
                    calculatePrices();
                    applyCoupon();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            event.preventDefault();
        }

        function applyCoupon() {
            const formData = new FormData(applyCouponForm);
            const couponCode = formData.get('coupon_code').trim();

            if (couponCode === '') {
                discountElement.textContent = '$0.00';
                calculatePrices();
                updateCheckoutPrice(); // Update the checkout price after discount is applied
                showCouponMessage('info', 'No coupon code applied.');
                return;
            }

            fetch('{{ route('apply.coupon') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        showCouponMessage('error', data.error);
                    } else {
                        subtotalElement.textContent = '$' + data.subtotal.toFixed(2);
                        discountElement.textContent = '$' + data.discount.toFixed(2);
                        totalPriceElement.textContent = '$' + data.totalPrice.toFixed(2);
                        updateCheckoutPrice(); // Update the checkout price after coupon is applied
                        showCouponMessage('success', 'Coupon applied successfully.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showCouponMessage('error', 'An error occurred while processing your request.');
                });
        }

        function deleteCartItem(cartItemId) {
            fetch(`{{ route('cart.destroy', '') }}/${cartItemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Failed to delete cart item');
                        });
                    }
                })
                .then(data => {
                    const cartItemRow = document.getElementById('cartItem' + cartItemId);
                    if (cartItemRow) {
                        cartItemRow.remove();
                    }
                    // Update cart display
                    updateCartDisplay(data.cartItems);
                    // Calculate prices
                    calculatePrices(data);
                    // Apply coupon after updating cart and calculating prices
                    applyCoupon();
                    showCouponMessage('success', 'Item removed from cart.');
                })
                .catch(error => {
                    console.error('Error:', error);
                    showCouponMessage('error', error.message ||
                        'An error occurred while processing your request.');
                });
        }

        function updateCartDisplay(cartItems) {
            cartItems.forEach(cartItem => {
                const cartItemRow = document.getElementById('cartItem' + cartItem.id);
                const quantityInput = cartItemRow.querySelector('input[name="quantity"]');
                const productTotalCell = cartItemRow.querySelector('.product-total');

                quantityInput.value = cartItem.quantity;
                productTotalCell.textContent = '$' + (cartItem.quantity * cartItem.coffee.price)
                    .toFixed(2);
            });

        }

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const cartItemId = button.getAttribute('data-id');
                deleteCartItem(cartItemId);
            });
        });

        applyCouponForm.addEventListener('submit', event => {
            event.preventDefault();
            applyCoupon();
        });

        quantityInputs.forEach(input => {
            const incrementButton = input.nextElementSibling;
            const decrementButton = input.previousElementSibling;

            incrementButton.addEventListener('click', () => updateQuantity(input, 'increment'));
            decrementButton.addEventListener('click', () => updateQuantity(input, 'decrement'));
        });
        calculatePrices()

        // Function to update the total price input value
        function updateCheckoutPrice() {
            const subtotal = parseFloat(subtotalElement.textContent.replace('$', ''));
            const totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));
            const discount = parseFloat(discountElement.textContent.replace('$', ''));

            getSubTotalPriceInput.value = subtotal;
            getCheckoutPriceInput.value = totalPrice;
            getDiscountInput.value = discount;
        }
        updateCheckoutPrice(); // Call to initially set the value

    });
</script>
