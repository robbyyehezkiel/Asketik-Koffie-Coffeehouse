<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <x-alert>

            </x-alert>
            <!-- Search bar -->
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <form id="filterForm" action="{{ route('coffees.index') }}" method="GET" class="input-group">
                        @auth
                            @if (auth()->user()->usertype === 'superadmin')
                                <a class="btn form-button d-flex align-items-center text-white" type="button"
                                    style="height: 50px; margin-right: 16px" href="{{ route('coffees.create') }}">
                                    <i class="fas fa-plus mr-2"></i> Add Coffee
                                </a>
                            @endif
                        @endauth
                        <input type="text" class="form-control" name="query" placeholder="Search for products..."
                            aria-label="Search products" style="height: 50px; font-size: 18px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary mr-4" type="submit" style="height: 50px;">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>

                        <div class="input-group-append">
                            <select id="categoryFilter" name="category">
                                <option value="">All Categories</option>
                                <option value="Milk Coffee">Milk Coffee</option>
                                <option value="Manual Brew">Manual Brew</option>
                                <option value="Non Coffee">Non Coffee</option>
                                <option value="Sparkling">Sparkling</option>
                                <option value="Foods">Foods</option>
                                <option value="Snacks">Snacks</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Search bar -->
            <div class="row product-lists">
                @if ($coffees && count($coffees) > 0)

                    @foreach ($coffees as $product)
                        <x-single-shop :product="$product">

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

<script>
    // JavaScript code to store the selected category and set the selected attribute
    document.addEventListener('DOMContentLoaded', function() {
        var category = "{{ request()->input('category') }}";
        if (category) {
            document.getElementById('categoryFilter').value = category;
        }
    });

    // JavaScript code to automatically submit the form when the dropdown selection changes
    document.getElementById('categoryFilter').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>
