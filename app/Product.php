<?php

namespace ATOZ;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'shipping_address', 'shipping_code', 'price', 'user_id', 'order_no'];
    
    public function orderDetail(){
        return $this->belongsTo('ATOZ\OrderDetail', 'order_no', 'order_no');
    }

    public static function generateShippingCode(){
        $code = random_bytes(4);
        return (strtoupper(bin2hex($code)));
    }

    public static function getTotalValue(String $value){
        return $value + 10000;
    }
}
