<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="/">
                                                <p><input type="text" placeholder="Name"></p>
                                                <p><input type="email" placeholder="Email"></p>
                                                <p><input type="text" placeholder="Address"></p>
                                                <p><input type="tel" placeholder="Phone"></p>
                                                <p>
                                                    <textarea name="bill" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shipping-address-form">
                                            <select id="province-select" class="form-control">
                                                <option value="">Select Province</option>
                                            </select>
                                            <select id="regency-select" class="form-control mt-3">
                                                <option value="">Select Regency/City</option>
                                            </select>
                                            <select id="district-select" class="form-control mt-3">
                                                <option value="">Select District</option>
                                            </select>
                                            <select id="village-select" class="form-control mt-3">
                                                <option value="">Select Village</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="/">
                                                <p><input type="text" id="card-number" name="card-number"
                                                        placeholder="Enter your card number" required></p>
                                                <p>
                                                    <input type="text" id="expiration-date" name="expiration-date"
                                                        placeholder="MM/YYYY" required>
                                                </p>
                                                <p>
                                                    <input type="text"id="cvv" name="cvv" placeholder="Enter CVV"
                                                        required>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                @foreach ($cartItems as $cartItem)
                                    <tr>
                                        <td>{{ $cartItem->coffee->name }}</td>
                                        <td>${{ $cartItem->quantity * $cartItem->coffee->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="order-details-body">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${{ $getDiscount }}</td>
                                </tr>
                            </tbody>
                            <tbody class="checkout-details">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${{ $getCheckoutPrice }}</td>
                                </tr>
                            </tbody>

                        </table>
                        <a href="#" class="boxed-btn">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
<script>
    $(document).ready(function() {
        // Fetch provinces and populate select dropdown
        $.ajax({
            url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
            method: 'GET',
            success: function(response) {
                var select = $('#province-select');
                $.each(response, function(index, province) {
                    select.append('<option value="' + province.id + '">' + province.name +
                        '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to fetch provinces. Please try again later.'); // Add error feedback
            }
        });

        // Event listener for province select change
        $('#province-select').on('change', function() {
            var provinceId = $(this).val();
            $('#regency-select, #district-select, #village-select').empty();
            if (provinceId) {
                // Fetch regencies/cities for the selected province
                $.ajax({
                    url: 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' +
                        provinceId + '.json',
                    method: 'GET',
                    success: function(response) {
                        var select = $('#regency-select');
                        $.each(response, function(index, regency) {
                            select.append('<option value="' + regency.id + '">' +
                                regency.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        // Event listener for regency select change
        $('#regency-select').on('change', function() {
            var regencyId = $(this).val();
            $('#district-select, #village-select').empty();
            if (regencyId) {
                // Fetch districts for the selected regency
                $.ajax({
                    url: 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/' +
                        regencyId +
                        '.json',
                    method: 'GET',
                    success: function(response) {
                        var select = $('#district-select');
                        $.each(response, function(index, district) {
                            select.append('<option value="' + district.id + '">' +
                                district.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        // Event listener for district select change
        $('#district-select').on('change', function() {
            var districtId = $(this).val();
            $('#village-select').empty();
            if (districtId) {
                // Fetch villages for the selected district
                $.ajax({
                    url: 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/' +
                        districtId + '.json',
                    method: 'GET',
                    success: function(response) {
                        var select = $('#village-select');
                        $.each(response, function(index, village) {
                            select.append('<option value="' + village.id + '">' +
                                village.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        // Get the value of getCheckoutPrice from PHP and assign it to a JavaScript variable
        var getCheckoutPrice = {!! json_encode($getCheckoutPrice) !!};
        console.log('getCheckoutPrice:', getCheckoutPrice);
    });
</script>
