<div class="col-lg-4 col-md-6 text-center">
    <div class="single-product-item">
        <div class="product-image">
            <a href="{{ route('coffees.show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Coffee Image"
                    style="width: 200px; height: 200px;">
            </a>
        </div>
        <h3>{{ $product->name }}</h3>
        <p class="product-price"><span>Per Item</span> Rp. {{ $product->price }} </p>
        <div class="button-container">
            @auth
                @if (auth()->user()->usertype === 'superadmin')
                    <a class="btn crud-button form-button bg-primary mr-2" style="display: inline-flex; align-items: center;"
                        href="{{ route('coffees.edit', $product->id) }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('coffees.destroy', $product->id) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirmDelete(event, {{ $product->id }})"
                            class="btn crud-button form-button text-white bg-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('cart.store') }}" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="coffee_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1" min="1" required>
                        <button type="submit" class="form-button center-btn">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                @endif
            @endauth
            @guest
                <form action="{{ route('cart.store') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="coffee_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" min="1" required>
                    <button type="submit" class="form-button center-btn">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            @endguest
        </div>
    </div>
</div>
