@extends('layouts.app')
<link href="{{ asset('css/table-order.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Pay Your Order</h2>
                </div>
                <form action="/payment/" method="post">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="order_number" type="text" placeholder="Order No." value="{{$order_number}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg btn-block">Pay Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
