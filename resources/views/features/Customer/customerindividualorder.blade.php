@extends('layouts.app')

@section('content')
    <div class="w-full">
        <div class="w-[100%] flex justify-center my-3 h-full">
            <div class="flex justify-center h-full w-[90%] rounded-lg">
                <div class="grid grid-cols-2 w-full gap-4">
                    <div class="col-span-1 w-full py-3 border-slate-500 px-5 bg-white shadow-md rounded-lg">
                        <div class="flex flex-col">
                            <div class="text-xl font-bold text-center">Order Info</div>
                            <div class="order-info mt-3">
                                <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                    <div class="font-bold">Full Name</div>
                                    <div>{{ $order->first_name }} {{ $order->middle_name }} {{ $order->last_name }}</div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                        <div class="font-bold">Total Price</div>
                                        <div>P{{ $order->total_price }}</div>
                                    </div>
                                    <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                        <div class="font-bold">Mode of Payment</div>
                                        <div>{{ $order->mode_of_payment }}</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                        <div class="font-bold">Commodity Type</div>
                                        <div>{{ $order->commodity_type }}</div>
                                    </div>
                                    <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                        <div class="font-bold">Segregation Type</div>
                                        <div>{{ $order->segregation_type }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-3">
                                    <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">
                                        <div class="font-bold">Status</div>
                                        <div class="text-yellow-500">{{ $order->status }}</div>
                                    </div>
                                </div>

                                @if ($order->status == 'Pending')
                                    <div class="grid grid-cols-1">
                                        <div class="border-slate-50 bg-slate-100 rounded-lg p-3 mb-3 shadow-inner">

                                            <div class="font-bold">Payment:</div>
                                            Wait for the driver to accept the Pick Up
                                        </div>
                                    </div>
                                @else
                                @endif

                            </div>
                        </div>
                        <div class="flex justify-start">

                        </div>
                    </div>
                    <div class="col-span-1 w-full py-3 border-slate-500 px-5 bg-slate-100 shadow-sm">
                        <div class="flex items-center flex-col w-full">
                            <div class="text-xl font-bold">Order Items</div>

                            <div class="order-items mt-3 w-full">
                                @foreach ($order_items as $order_item)
                                    <div class="border-white bg-white rounded-lg p-3 mb-3 shadow-inner w-full">
                                        <div class="text-xl">{{ $order_item->item_name }}</div>
                                        <div class="text-sm text-gray-400">P{{ $order_item->item_price }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
