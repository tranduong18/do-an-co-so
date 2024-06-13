<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'sub_category';
    
    static public function getSingle($id)
    {
         return self::find($id);
    }
    static public function getRecord(){

        return self::select('sub_category.*', 'users.name as created_by_name', 'category.name as category_name')
                ->join('category', 'category.id', '=', 'sub_category.category_id')
                ->join('users', 'users.id', '=', 'sub_category.created_by')
                ->where('sub_category.is_delete', '=', 0)
                ->orderBy('sub_category.id', 'desc')
                ->paginate(50);
    }
}
