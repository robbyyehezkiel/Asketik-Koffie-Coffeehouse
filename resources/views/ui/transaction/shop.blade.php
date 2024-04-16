<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')


    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <!-- Search bar -->
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <form action="#" method="GET" class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products..."
                            aria-label="Search products" style="height: 50px; font-size: 18px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" style="height: 50px;">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Search bar -->
            <div class="row product-lists">
                @if ($coffees && count($coffees) > 0)

                    @foreach ($coffees as $product)
                        <x-single-shop :coffee="$product">

                        </x-single-shop>
                    @endforeach
                @else
                    <div class="col-lg-12 text-center">
                        <p>No coffees available.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end products -->
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
