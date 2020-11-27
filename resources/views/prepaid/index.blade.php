@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2 class="mb-0">Prepaid Balance</h2></div>
                <div class="card-body">
                    <form action="/prepaid-balance" method="post">
                        @csrf
                        <div class="container">
                            <div class="form-group row">
                                <input type="text" class="form-control {{$errors->has('mobile_number') ? 'is-invalid' : ''}}" name="mobile_number" id="mobile_number" placeholder="Mobil Number" value="{{old('mobile_number')}}">
                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <select name="value" class="custom-select {{$errors->has('value') ? 'is-invalid' : ''}}">
                                    <option disabled selected hidden>Value</option>
                                    <option value="10000">10000</option>
                                    <option value="50000">50000</option>
                                    <option value="100000">100000</option>
                                </select>
                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
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
