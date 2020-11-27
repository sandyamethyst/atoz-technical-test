<?php

namespace ATOZ;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_no', 'total', 'status', 'order_type_id'];
    public static function generateOrderNumber(){
        $number = '';
        for($i = 0; $i < 10; $i++) 
        { 
            $number .= mt_rand(0, 9); 
        }
        return $number;
    }

    public function topup(){
        return $this->hasOne('ATOZ\Topup', 'order_no', 'order_no');
    }

    public function product(){
        return $this->hasOne('ATOZ\Product', 'order_no', 'order_no');
    }
}
