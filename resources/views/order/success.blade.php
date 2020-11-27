@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2 class="mb-0">Success!!</h2></div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-muted"><strong>Order No.</strong></td>
                                <td class="text-muted text-right"><strong>{{ chunk_split($order_number, 4, ' ') }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted"><strong>Total</strong></td>
                                <td class="text-muted text-right"><strong>Rp {{ $total }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="container">
                        <p class="text-muted">
                            <strong>
                                @if ($order_type_id === config('global.ORDER_TYPE_TOPUP'))
                                    {{"Your mobile phone number ".$mobile_number." will receive Rp ".$value}}
                                @elseif($order_type_id === config('global.ORDER_TYPE_PRODUCT'))
                                    {{$product_name." that costs Rp ".$price." will be shipped to ". $shipping_address. " only after you pay."}}
                                @endif
                            </strong>
                        </p>
                    </div>

                    <div class="form-group">
                        <form action="/payment" method="post">
                            @csrf
                            <input type="hidden" name="order_number" value="{{$order_number}}">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
