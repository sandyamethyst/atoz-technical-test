<?php

namespace ATOZ\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use ATOZ\Http\Requests\PrepaidsPostFormRequest;

use ATOZ\Topup;
use ATOZ\OrderDetail;
use ATOZ\Jobs\CancelPaymentJob;

class PrepaidsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('prepaid.index');
    }

    public function store(PrepaidsPostFormRequest $request){
        $total_value = Topup::getTotalValue($request->value);
        $order_number = OrderDetail::generateOrderNumber();
        Topup::create([
            'mobile_number' => $request->mobile_number,
            'value' => $request->value,
            'user_id' => $this->getUserId(),
            'order_no' => $order_number,
        ]);

        OrderDetail::create([
            'order_no' => $order_number,
            'total' => $total_value,
            'status' => config('global.STATUS_WAITING'),
            'order_type_id' => config('global.ORDER_TYPE_TOPUP')
        ]);

        return view('order.success')->with('order_number', $order_number)
                             ->with('total', $total_value)
                             ->with('mobile_number', $request->mobile_number)
                             ->with('value', $request->value)
                             ->with('order_type_id', config('global.ORDER_TYPE_TOPUP'));
    }

    public function getUserId(){
        return Auth::id();
    }

    public function cancelPayment(){
        $cancel_payment = (new CancelPaymentJob())->delay(Carbon::now()->addMinutes(5));
        dispatch($cancel_payment);
    }
}
