<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <!-- featured section -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="total-section mb-4">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row text-center">
                                    <th><b>Add Coffee Data</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td>
                                        <div class="coupon-section">
                                            <div class="billing-address-form">
                                                <!-- Add your form for storing coffee here -->
                                                <form action="{{ route('coffees.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <p>
                                                        <input id="name" type="text" name="name"
                                                            placeholder="Enter coffee name" required>
                                                    </p>
                                                    <p>
                                                        <input type="number" name="price" id="price"
                                                            placeholder="Enter price" required>
                                                    </p>
                                                    <p>
                                                        <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
                                                    </p>
                                                    <p>
                                                        <input type="file" name="image" class="form-control-file"
                                                            id="image">
                                                    </p>
                                                    <button type="submit" class="form-button">Submit</button>
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
        </div>
    </div>
    <!-- end featured section -->

    <x-slot name="footer">

    </x-slot>
</x-app-layout>
