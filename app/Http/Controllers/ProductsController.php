<?php

namespace ATOZ\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use ATOZ\Http\Requests\ProductPostFormRequest;
use ATOZ\Product;
use ATOZ\OrderDetail;
use ATOZ\Jobs\CancelPaymentJob;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('product.index');
    }

    public function store(ProductPostFormRequest $request){
        $total_value = Product::getTotalValue($request->price);
        $order_number = OrderDetail::generateOrderNumber();

        Product::create([
            'product_name' => $request->product_name,
            'shipping_address' => $request->shipping_address,
            'price' => $request->price,
            'user_id' => $this->getUserId(),
            'order_no' => $order_number,
        ]);

        OrderDetail::create([
            'order_no' => $order_number,
            'total' => $total_value,
            'status' => config('global.STATUS_WAITING'),
            'order_type_id' => config('global.ORDER_TYPE_PRODUCT')
        ]);

        return view('order.success')->with('order_number', $order_number)
                ->with('total', $total_value)
                ->with('product_name', $request->product_name)
                ->with('price', $request->price)
                ->with('shipping_address', $request->shipping_address)
                ->with('order_type_id', config('global.ORDER_TYPE_PRODUCT'));
    }

    public function getUserId(){
        return Auth::id();
    }

    public function cancelPayment(){
        $cancel_payment = (new CancelPaymentJob())->delay(Carbon::now()->addMinutes(5));
        dispatch($cancel_payment);
    }
}
