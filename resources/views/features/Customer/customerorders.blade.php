@extends('layouts.app')

@section('content')
    <div class="w-full flex justify-center">
        <div class="w-[90%]">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Laundry</th>
                        <th>Total Price</th>
                        <th>Commodity Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>P{{ $order->total_price }}</td>
                            <td>{{ $order->commodity_type }}</td>
                            <td>
                                @if ($order->status == 'Pending')
                                    <span class="text-yellow-500">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="/customer/orders/{{ $order->id }}">
                                    <span class="text-blue-500 underline cursor-pointer">View</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>
@endsection
