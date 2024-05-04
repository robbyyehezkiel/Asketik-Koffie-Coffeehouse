<x-app-layout>
    <x-slot name="pageTitle">
        {{ $pageTitle }}
    </x-slot>

    @include('layouts.partials.breadcrumb')
    <div class="full-height-section error-section mt-150 mb-150">
        <div class="full-height-tablecell">
            <div class="container">
                <h1>Orders</h1>
                @if ($orders->isEmpty())
                    <p>No orders found.</p>
                @else
                    <div class="text-center"> <!-- Add text-center class here -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Item</th>
                                    <th>Total</th>
                                    <th>Order Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>
                                            <!-- Button to trigger modal -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#orderItemsModal{{ $order->id }}">
                                                View Order Items
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="orderItemsModal{{ $order->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="orderItemsModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="orderItemsModalLabel">Order
                                                                Items
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order->items as $item)
                                                                        <tr>
                                                                            <td>{{ $item->coffee->name }}</td>
                                                                            <td>{{ $item->quantity }}</td>
                                                                            <td>{{ $item->price }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            @if ($order->status == 'finished')
                                                <span class="btn btn-success">
                                                    <i class="fas fa-check-circle"></i> Completed
                                                </span>
                                            @elseif ($order->status == 'pending')
                                                <span class="btn btn-warning">
                                                    <i class="fas fa-exclamation-circle"></i> Pending
                                                </span>
                                            @elseif ($order->status == 'rejected')
                                                <span class="btn btn-danger">
                                                    <i class="fas fa-times-circle"></i> Rejected
                                                </span>
                                            @elseif ($order->status == 'processing')
                                                <span class="btn btn-info">
                                                    <i class="fas fa-sync-alt fa-spin"></i> Processing
                                                </span>
                                            @elseif ($order->status == 'pick up')
                                                <!-- New status: pick up -->
                                                <span class="btn btn-primary">
                                                    <i class="fas fa-hand-paper"></i> Pick Up
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'finished' || $order->status == 'pick up')
                                                <!-- Added 'pick up' status -->
                                                <span class="btn btn-secondary">
                                                    <i class="fas fa-check"></i> Accepted
                                                </span>
                                            @elseif ($order->status == 'pending')
                                                <form action="{{ route('order.accept') }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-check"></i> Accept
                                                    </button>
                                                </form>
                                                <form action="{{ route('order.reject') }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            @elseif ($order->status == 'processing')
                                                <form action="{{ route('order.pickup') }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-shopping-bag"></i> Ready for Pick Up
                                                    </button>
                                                </form>
                                            @elseif ($order->status == 'rejected')
                                                <span class="btn btn-secondary">
                                                    <i class="fas fa-times"></i> Rejected
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-slot name="footer">
    </x-slot>
</x-app-layout>
