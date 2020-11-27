<?php

namespace ATOZ;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = "topup";
    protected $fillable = ['mobile_number', 'value', 'user_id', 'order_no'];

    public function orderDetail(){
        return $this->belongsTo('ATOZ\OrderDetail', 'order_no', 'order_no');
    }

    public static function getTotalValue(String $value){
        return $value + ($value * 0.05);
    }
}
