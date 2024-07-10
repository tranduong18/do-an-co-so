<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemModel extends Model
{
    use HasFactory;
    protected $table = 'orders_item';

    public function getProduct(){
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

    static public function getSingle($product_id){
        return self::where('product_id','=', $product_id)
            ->first();
    }

    static public function getReview($product_id, $order_id){
        return ProductReviewModel::getReview($product_id, $order_id, Auth::user()->id);
    }
}
