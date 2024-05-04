<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <!-- edit coffee section -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="total-section mb-4">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row text-center">
                                    <th><b>Edit Coffee Data</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td>
                                        <div class="billing-address-form">
                                            <!-- Form for updating coffee -->
                                            <form action="{{ route('coffees.update', $coffee->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Use PUT method for update -->
                                                <p>
                                                    <input id="name" type="text" name="name"
                                                        placeholder="Enter coffee name" required
                                                        value="{{ $coffee->name }}"> <!-- Pre-fill name -->
                                                </p>
                                                <p>
                                                    <input type="number" name="price" id="price"
                                                        placeholder="Enter price" required value="{{ $coffee->price }}">
                                                    <!-- Pre-fill price -->
                                                </p>
                                                <p>
                                                    <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{ $coffee->description }}</textarea>
                                                    <!-- Pre-fill description -->
                                                </p>
                                                <p>
                                                    <input type="file" name="image" class="form-control-file"
                                                        id="image">
                                                    <!-- Image upload can be optional for edit -->
                                                </p>
                                                <button type="submit" class="form-button">Update</button>
                                            </form>
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
    <!-- end edit coffee section -->

    <x-slot name="footer">

    </x-slot>
</x-app-layout>
