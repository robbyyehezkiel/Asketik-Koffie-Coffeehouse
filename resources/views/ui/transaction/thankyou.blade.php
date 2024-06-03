<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')

    <div class="container mt-150 mb-150">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="cart-table-wrap mb-4">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-name">Order ID: <b>{{ $order->id }}</b></th>
                                <th class="product-quantity">Customer Id: <b>{{ $order->user->id }}</b></th>
                                <th class="product-price">Customer Name: <b>{{ $order->order_name }}</b></th>
                                <th class="product-price">Total Price: <b>Rp. {{ $order->total }}</b></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="cart-table-wrap mb-4">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-name">Name</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-price">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orderItems->isNotEmpty())
                                <!-- Check if order items are not empty -->
                                @foreach ($orderItems as $orderItem)
                                    <tr id="cartItem{{ $orderItem->id }}" class="table-body-row">
                                        <td class="product-image">
                                            {{ $orderItem->coffee->name }}
                                        </td>
                                        <td class="product-name">{{ $orderItem->quantity }}</td>
                                        <td class="product-price">Rp. {{ $orderItem->price }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">No order items found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


                <div class="text-center mb-4">
                    <!-- Pick Up Order button -->
                    <button id="pickUpOrder" class="form-button" style="display: none;">Pick Up Order</button>

                    <!-- Check Order Status button -->
                    <button id="checkOrderStatus" class="form-button">Check Order Status</button>
                </div>



            </div>

            <div class="col-lg-3 col-md-12">
                <img id="orderImage" src="{{ asset('assets/img/order_waiting.gif') }}"
                    alt="This is an animated gif image, but it does not move" />
                <div id="countdown" style="text-align: center; font-size: 24px;">
                    <div id="statusText" style="text-align: center; font-size: 24px;">
                        <span class="btn btn-warning">
                            <i class="fas fa-exclamation-circle"></i> Pending
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">

    </x-slot>
</x-app-layout>
<script>
    document.getElementById('checkOrderStatus').addEventListener('click', function() {
        var orderId = '{{ $order_id }}';

        fetch('/get-order-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId
                })
            })
            .then(response => response.json())
            .then(data => {
                switch (data.status) {
                    case 'pending':
                        document.getElementById('orderImage').src =
                            '{{ asset('assets/img/order_waiting.gif') }}';
                        document.getElementById('statusText').innerHTML =
                            '<span class="btn btn-warning"><i class="fas fa-exclamation-circle"></i> Pending</span>';
                        alert('Your order is pending.');
                        break;
                    case 'rejected':
                        document.getElementById('orderImage').src =
                            '{{ asset('assets/img/order_reject.gif') }}';
                        document.getElementById('statusText').innerHTML =
                            '<span class="btn btn-danger"><i class="fas fa-times-circle"></i> Rejected</span>';
                        alert('Your order has been rejected.');
                        break;
                    case 'processing':
                        document.getElementById('orderImage').src =
                            '{{ asset('assets/img/order_process.gif') }}';
                        document.getElementById('statusText').innerHTML =
                            '<span class="btn btn-info"><i class="fas fa-sync-alt fa-spin"></i> Processing</span>';
                        alert('Your order is being processed.');
                        break;
                    case 'pick up':
                        document.getElementById('orderImage').src =
                            '{{ asset('assets/img/order_pickup.gif') }}';
                        document.getElementById('statusText').innerHTML =
                            '<span class="btn btn-primary"><i class="fas fa-hand-paper"></i> Pick Up</span>';
                        document.getElementById('pickUpOrder').style.display =
                            'block'; // Show Pick Up Order button
                        document.getElementById('checkOrderStatus').style.display =
                            'none'; // Hide Check Order Status button
                        break;
                    case 'finished':
                        break;
                    default:
                        // Handle unknown status
                }
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('pickUpOrder').addEventListener('click', function() {
        var orderId = '{{ $order_id }}';

        fetch('/order/finish', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('orderImage').src =
                        '{{ asset('assets/img/order_finish.gif') }}';
                    document.getElementById('statusText').innerHTML =
                        '<span class="btn btn-success"><i class="fas fa-check-circle"></i> Completed</span>';
                    alert('Order successfully marked as completed.');
                } else {
                    alert('Failed to mark order as completed.');
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
