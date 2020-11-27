<?php

namespace ATOZ\Http\Controllers;

use Illuminate\Http\Request;

use ATOZ\OrderDetail;
use ATOZ\Topup;
use ATOZ\Product;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(!empty($request)){
            $orders = OrderDetail::with('Topup')
            ->with('Product')
            ->where('order_no', 'like', '%' . $request->order_number . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        }
        if(empty($request)){
            $orders = OrderDetail::with('Topup')
            ->with('Product')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        }
        return view('order.index')->with(compact('orders'));
    }

    public function payment(Request $request){
        return view('order.payment')->with('order_number', $request->order_number);
    }

    public function processPayment(Request $request){
        $message = '';
        $order_type = OrderDetail::where('order_no', $request->order_number)
                                ->where('status', config('global.STATUS_WAITING'))
                                ->get('order_type_id');

        if($order_type->count() > 0 && $order_type[0]->order_type_id === config('global.ORDER_TYPE_TOPUP')){
            $random = rand(1,100);
            if(date('H') > 9 && date('H') < 17){
                if($random > 0 && $random < 90){
                    OrderDetail::where('order_no', $request->order_number)
                                ->where('status', config('global.STATUS_WAITING'))
                                ->update(['status' => config('global.STATUS_SUCCESS')]);
                    $message = 'Payment Successful!';
                }else{
                    OrderDetail::where('order_no', $request->order_number)
                                ->where('status', config('global.STATUS_WAITING'))
                                ->update(['status' => config('global.STATUS_FAILED')]);
                    $message = 'Payment Failed!';
                }
            }else{
                if($random > 0 && $random < 40){
                    OrderDetail::where('order_no', $request->order_number)
                                ->where('status', config('global.STATUS_WAITING'))
                                ->update(['status' => config('global.STATUS_SUCCESS')]);
                    $message = 'Payment Successful!';
                }else{
                    OrderDetail::where('order_no', $request->order_number)
                                ->where('status', config('global.STATUS_WAITING'))
                                ->update(['status' => config('global.STATUS_FAILED')]);
                    $message = 'Payment Failed!';
                }
            }        
        }else if($order_type->count() > 0 && $order_type[0]->order_type_id === config('global.ORDER_TYPE_PRODUCT')) {
            $shipping_code = Product::generateShippingCode();
            OrderDetail::where('order_no', $request->order_number)
                ->where('status', config('global.STATUS_WAITING'))
                ->update(['status' => config('global.STATUS_SUCCESS')]);
            
            Product::where('order_no', $request->order_number)
                ->where('status', config('global.STATUS_WAITING'))
                ->update(['shipping_code' => $shipping_code]);

            $message = 'Payment Successful!';
        }else if($order_type->count() < 1){
            $message = 'Order has been cancelled by the system!';
        }

        session()->flash('payment', $message);
        return redirect('order');
    }
}
