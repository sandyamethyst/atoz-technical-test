@extends('layouts.app')
<link href="{{ asset('css/table-order.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif
            @if(session('payment'))
                <div class="alert alert-info">
                    {{ session('payment') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h2 class="mb-0">Order History</h2></div>

                <div class="card-body">
                    @if (!empty($orders))
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="separator" colspan="3">
                                        <form action="/" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <input class="form-control form-control-lg" type="text" placeholder="Order No." name="order_number" value="">
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-info mr-2" type="submit">Search</button>
                                                <a href="/" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                        @foreach ($orders as $order)
                                <tr>
                                    <td class="text-muted"><strong>{{chunk_split($order->order_no, 4, ' ') }}</strong></td>
                                    <td class="text-muted"><strong>Rp {{$order->total}}</strong></td>
                                    <td rowspan="2" class="separator status">
                                        @if ($order->status === config('global.STATUS_WAITING'))
                                        <form action="/payment" method="post">
                                            @csrf
                                            <input type="hidden" name="order_number" value="{{$order->order_no}}">
                                            <button class="btn btn-primary btn-lg">Pay Now</button>    
                                        </form>
                                        @elseif($order->status === config('global.STATUS_SUCCESS'))
                                            @if ($order->order_type_id === config('global.ORDER_TYPE_TOPUP'))
                                                <p class="text-success h3">Success</p>
                                            @elseif($order->order_type_id === config('global.ORDER_TYPE_PRODUCT'))
                                                <p class="h3">Shipping Code <br>{{$order->product->shipping_code}}</p>
                                            @endif
                                        @elseif($order->status === config('global.STATUS_FAILED'))
                                            <p class="text-warning h3">Failed</p>
                                        @elseif($order->status === config('global.STATUS_CANCELED'))
                                            <p class="text-danger h3">Canceled</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    @if ($order->order_type_id === config('global.ORDER_TYPE_TOPUP'))
                                        <td colspan="2" class="separator"><strong>{{$order->topup->value}} for {{$order->topup->mobile_number}}</strong></td>
                                    @elseif($order->order_type_id === config('global.ORDER_TYPE_PRODUCT'))
                                        <td colspan="2" class="separator"><strong>{{$order->product->product_name}} that costs Rp {{$order->product->price}}</strong></td>
                                    @endif
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$orders->links()}}     
                    </div>    
                    @else
                        <H3>No Orders has been made</H3>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
