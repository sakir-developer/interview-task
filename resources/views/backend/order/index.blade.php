@extends('layouts.backend.app')
@push('title') Orders @endpush
@push('style')
    <link href="{{ asset('assets/backend/dist/css/pages/stylish-tooltip.css') }}" rel="stylesheet">
@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Orders</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-2">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white">{{ $orders->count() }}</h1>
                        <h6 class="text-white">Total Order</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-2">
                <div class="card">
                    <div class="box bg-primary text-center">
                        <h1 class="font-light text-white">{{ $orders->where('delivered' , false)->count() }}</h1>
                        <h6 class="text-white">Completed In Completed</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-2">
                <div class="card">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white">{{ $orders->where('delivered' , true)->count() }}</h1>
                        <h6 class="text-white">Completed Completed</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Orders Table</h4>
                        <div class="table-responsive">
                            <table class="table color-bordered-table success-bordered-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Order Info.</th>
                                    <th>Delivery</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr @if($order->delivered) class="table-success" @endif>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <b>Name: &nbsp;</b> {{ $order->user->name }} <br>
                                            <b>Phone: &nbsp;</b> {{ $order->phone }} <br>
                                            <b>Email @: &nbsp;</b> {{ $order->user->email }} <br>
                                            <b>Address: &nbsp;</b> {{ $order->address }}
                                        </td>
                                        <td>
                                            <b>Quantity: &nbsp;</b>{{ $order->items->count() }} <br>
                                            <b>Total Price:
                                                &nbsp;</b>BDT {{ \App\Models\Product::whereIn('id', $order->items->pluck('product_id'))->sum('price') }}
                                            <br>
                                            <b>Order Time: &nbsp;</b>{{ $order->created_at->format('h:m a d-m-Y') }}
                                            <br>
                                            <a class="mytooltip" href="javascript:void(0)"> <i
                                                    class="fa fa-fw fa-edit"></i>Order note <span
                                                    class="tooltip-content3"> {{ $order->note }}</span> </a>

                                        </td>
                                        <td>
                                            @if($order->delivered)
                                                Order Process <br> completed <br> Time:
                                                &nbsp;</b>{{ $order->updated_at->format('h:m a d-m-Y') }}
                                            @else
                                                Order Process <br> in completed
                                            @endif
                                        </td>
                                        <td>
                                            <div class="col-8 mb-2">
                                                <a href="{{ route('admin.orders.show', $order) }}" type="button"
                                                   class="btn waves-effect waves-light btn-block btn-info">Show {{ $order->items->count() }}</a>
                                            </div>
                                            <div class="col-8">
                                                <button type="button"
                                                        class="btn waves-effect waves-light btn-block btn-primary"
                                                        onclick="delete_function(this)"
                                                        value="{{ route('admin.orders.destroy', $order) }}">Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('script')

@endpush
