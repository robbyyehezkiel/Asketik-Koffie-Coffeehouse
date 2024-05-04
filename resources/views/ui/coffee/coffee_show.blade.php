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
                        <img src="{{ asset('storage/' . $coffee->image) }}" alt="{{ $coffee->name }}"
                            style="width: 360px; height: 360px;">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="single-product-content">
                        <h2>{{ $coffee->name }}</h2>
                        <p style="font-size: 18px; font-weight: bold">Rp. {{ $coffee->price }}</p>
                        <p>{{ $coffee->description }}</p>
                        <p><strong class="category-label">Categories: </strong>{{ $coffee->category }}</p>
                        <h4>Social Media:</h4>
                        <ul class="product-share">
                            <li><a href="https://m.facebook.com/p/Asketik-Koffie-100087181167935/"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/asketikoffie?igsh=MXNyZWNrYWNkdjZ3Zg=="><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.tiktok.com/@asketikkoffie?_t=8lsSEJsQmVW&_r=1"><i
                                        class="fa-brands fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="single-product-form">
                        @auth
                            @if (auth()->user()->usertype === 'superadmin')
                                <div class="border p-4">

                                    <input type="hidden" name="coffee_id" value="{{ $coffee->id }}">
                                    <div class="form-group invoice-container">
                                        <div class="quantity-input">
                                            <button type="button" class="btn btn-number decrease"
                                                onclick="decrementQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1"
                                                min="1" onchange="calculateSubtotal()">
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
                                    <div class="text-center">
                                        <a class="btn crud-button form-button bg-primary"
                                            style="display: inline-flex; align-items: center;"
                                            href="{{ route('coffees.edit', $coffee->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('coffees.destroy', $coffee->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirmDelete(event, {{ $coffee->id }})"
                                                class="btn crud-button form-button text-white bg-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @else
                                <form action="{{ route('cart.store') }}" method="POST" class="border p-4">
                                    @csrf
                                    <input type="hidden" name="coffee_id" value="{{ $coffee->id }}">
                                    <div class="form-group invoice-container">
                                        <div class="quantity-input">
                                            <button type="button" class="btn btn-number decrease"
                                                onclick="decrementQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1"
                                                min="1" onchange="calculateSubtotal()">
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
                            @endif
                        @endauth

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
                        <p>Nikmati produk kami lainnya sesuai kategori yang kamu inginkan</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $product)
                    <x-single-shop :product="$product">
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
    });

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
