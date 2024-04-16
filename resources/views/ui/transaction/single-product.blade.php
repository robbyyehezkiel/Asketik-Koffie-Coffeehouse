<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-img">
                        <img src="{{ asset('assets/' . $coffee->image) }}" alt="{{ $coffee->name }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="single-product-content">
                        <h2>{{ $coffee->name }}</h2>
                        <p style="font-size: 18px; font-weight: bold">Rp. {{ $coffee->price }}</p>
                        <p>{{ $coffee->description }}</p>
                        <p><strong class="category-label">Categories: </strong>{{ $coffee->categories }}</p>
                        <h4>Share:</h4>
                        <ul class="product-share">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-product-form">
                        <form action="{{ route('cart.store') }}" method="POST" class="border p-4">
                            @csrf
                            <input type="hidden" name="coffee_id" value="{{ $coffee->id }}">
                            <div class="form-group invoice-container">
                                <div class="quantity-input">
                                    <button type="button" class="btn btn-number decrease"
                                        onclick="decrementQuantity()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1"
                                        onchange="calculateSubtotal()">
                                    <button type="button" class="btn btn-number increase"
                                        onclick="incrementQuantity()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div id="warning" class="warning-message">Minimum input is 1</div>
                            </div>
                            <hr class="invoice-divider">
                            <span id="subtotal" class="center-text">Rp. 0.00</span>
                            <hr class="invoice-divider">
                            <button type="submit" class="form-button center-btn"><i
                                    class="fas fa-shopping-cart mr-2"></i> Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->

    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($coffees as $product)
                    <x-single-shop :coffee="$product">

                    </x-single-shop>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end more products -->
    <x-slot name="footer"></x-slot>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        calculateSubtotal();

        // Event listener for add to cart button in related products
        document.querySelectorAll('.form-button').forEach(button => {
            button.addEventListener('click', function() {
                addToCart(this.dataset.productId);
            });
        });
    });

    function addToCart(productId) {
        fetch('{{ route('cart.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    coffee_id: productId,
                    quantity: 1
                })
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '{{ route('cart.index') }}';
                } else {
                    console.error('Failed to add product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function calculateSubtotal() {
        var quantity = parseInt(document.getElementById('quantity').value);
        var price = {{ $coffee->price }};
        var subtotal = quantity * price;
        document.getElementById('subtotal').textContent = `Rp. ${subtotal.toFixed(2)}`;
        document.getElementById('warning').style.display = quantity < 1 ? 'block' : 'none';
    }

    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        calculateSubtotal();
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            calculateSubtotal();
        } else {
            document.getElementById('warning').style.display = 'block';
        }
    }
</script>
