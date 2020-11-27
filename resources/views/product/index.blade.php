@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2 class="mb-0">Product Page</h2></div>
                <div class="card-body">
                    <form action="/product" method="post">
                        @csrf
                        <div class="container">
                            <div class="form-group row">
                                <textarea class="form-control {{$errors->has('product_name') ? 'is-invalid' : ''}}" name="product_name" id="product_name" placeholder="Product" style="resize:none">{{old('product_name')}}</textarea>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_name') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <textarea class="form-control {{$errors->has('shipping_address') ? 'is-invalid' : ''}}" name="shipping_address" id="shipping_address" placeholder="Shipping Address" style="resize:none">{{old('shipping_address')}}</textarea>
                                @error('shipping_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <input type="text" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" name="price" id="price" placeholder="Price" value="{{old('price')}}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
