<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    static public function checkSlug($slug){
        return self::where('slug', '=', $slug)->count();
    }

    static public function getRecord(){
        return self::select('product.*', 'users.name as created_by_name')
                ->join('users', 'users.id', '=', 'product.created_by')
                ->where('product.is_delete', '=', 0)
                ->orderBy('product.id', 'desc')
                ->paginate(15);
    }

    static public function getSingle($id){
        return self::find($id);
    }
}
