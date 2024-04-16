<div class="col-lg-4 col-md-6 text-center">
    <form action="{{ route('cart.store') }}" method="POST">
        <div class="single-product-item">
            @csrf
            <div class="product-image">
                <!-- Assuming your coffee images are stored in a field named 'image' in the database -->
                <a href="{{ route('coffees.show', $coffee->id) }}">
                    <img src="{{ asset('assets/' . $coffee->image) }}" alt="" height="200">
                </a>
            </div>
            <h3>{{ $coffee->name }}</h3>
            <p class="product-price"><span>Per Item</span> {{ $coffee->price }} </p>
            <input type="hidden" name="coffee_id" value="{{ $coffee->id }}">
            <input type="hidden" name="quantity" value="1" min="1" required>
            <button type="submit" class="form-button center-btn">
                <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
            </button>
        </div>
    </form>
</div>
