<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            ->first();
    }

    static public function checkSlug($slug)
    {
        return self::where('slug', '=', $slug)->count();
    }

    static public function checkWishlist($product_id)
    {
        return Product_WishlistModel::checkAlready($product_id, Auth::user()->id);
    }

    static public function getMyWishlist($user_id)
    {
        $return = ProductModel::select(
            'product.*',
            'users.name as created_by_name',
            'sub_category.name as sub_category_name',
            'sub_category.slug as sub_category_slug',
            'category.name as category_name',
            'category.slug as category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->join('product_wishlist', 'product_wishlist.product_id', '=', 'product.id')
            ->where('product_wishlist.user_id', '=', $user_id)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            // ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->paginate(10);
        return $return;
    }
    static public function getRecentArrival(){
        $return = ProductModel::select(
            'product.*',
            'users.name as created_by_name',
            'sub_category.name as sub_category_name',
            'sub_category.slug as sub_category_slug',
            'category.name as category_name',
            'category.slug as category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0);
            if(!empty(Request::get('category_id')))
            {
                $return = $return->where('product.category_id', '=', Request::get('category_id'));
            }
            $return = $return->groupBy('product.id')
            ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(6);

 
        return $return;
    }
    static public function getProduct($category_id = '', $subcategory_id = '')
    {
        $return = ProductModel::select(
            'product.*',
            'users.name as created_by_name',
            'sub_category.name as sub_category_name',
            'sub_category.slug as sub_category_slug',
            'category.name as category_name',
            'category.slug as category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id');

        if (!empty($category_id)) {
            $return = $return->where('product.category_id', $category_id);
        }
        if (!empty($subcategory_id)) {
            $return = $return->where('product.sub_category_id', $subcategory_id);
        }
        if (!empty(Request::get('sub_category_id'))) {
            $sub_category_id = rtrim(Request::get('sub_category_id'), ',');
            $sub_category_id_array = explode(',', $sub_category_id);
            $return = $return->whereIn('product.sub_category_id', $sub_category_id_array);
        } else {
            if (!empty(Request::get('old_category_id'))) {
                $return = $return->where('product.category_id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {
                $return = $return->where('product.sub_category_id', '=',  Request::get('old_sub_category_id'));
            }
        }
        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(',', $brand_id);
            $return = $return->whereIn('product.brand_id', $brand_id_array);
        }
        if (!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {
            $start_price = str_replace('$', '', Request::get('start_price'));
            $end_price = str_replace('$', '', Request::get('end_price'));
            $return = $return->where('product.price', '>=', $start_price);
            $return = $return->where('product.price', '<=', $end_price);
        }
        if (!empty(Request::get('color_id'))) {
            $color_id = rtrim(Request::get('$color_id'), ',');
            $color_id_array = explode(',', $color_id);
            $return = $return->join('product', 'product_color.product_id', '=', 'product.id');
            $return = $return->whereIn('product_color.color_id', $color_id_array);
        }
        if (!empty(Request::get('q'))) {
            $return = $return->where('product.title', 'like', '%' . Request::get('q') . '%');
        }
        $return = $return->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            // ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->paginate(10);
        return $return;
    }

    static public function getRelatedProduct($product_id, $sub_category_id)
    {
        $return = ProductModel::select(
            'product.*',
            'users.name as created_by_name',
            'sub_category.name as sub_category_name',
            'sub_category.slug as sub_category_slug',
            'category.name as category_name',
            'category.slug as category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where('product.id', '!=', $product_id)
            ->where('product.sub_category_id', '=', $sub_category_id)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            // ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(10)
            ->get();
        return $return;
    }

    static public function getProductTrendy()
    {
        $return = ProductModel::select(
            'product.*',
            'users.name as created_by_name',
            'sub_category.name as sub_category_name',
            'sub_category.slug as sub_category_slug',
            'category.name as category_name',
            'category.slug as category_slug'
        )
            ->join('users', 'users.id', '=', 'product.created_by')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'product.sub_category_id')
            ->where('product.is_trendy', '=', 1)
            ->where('product.is_delete', '=', 0)
            ->where('product.status', '=', 0)
            // ->groupBy('product.id')
            ->orderBy('product.id', 'desc')
            ->limit(10)
            ->get();
        return $return;
    }

    static public function getImageSingle($product_id)
    {
        return ProductImageModel::where('product_id', '=', $product_id)->orderBy('order_by', 'asc')->first();
    }

    static public function getRecord()
    {
        return self::select('product.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'product.created_by')

            ->where('product.is_delete', '=', 0)
            ->orderBy('product.id', 'desc')
            ->paginate(10);
    }

    public function getColor()
    {
        return $this->hasMany(ProductColorModel::class, "product_id");
    }

    public function getSize()
    {
        return $this->hasMany(ProductSizeModel::class, "product_id");
    }

    public function getImage()
    {
        return $this->hasMany(ProductImageModel::class, "product_id")->orderBy('order_by', 'asc');
    }

    public function getCategory()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');
    }

    public function getTotalReview()
    {
        return $this->hasMany(ProductReviewModel::class,'product_id')
                    ->join('users', 'users.id', 'product_review.user_id')
                    ->count();    
    }

    static public function getReviewRating($product_id)
    {
        $avg = ProductReviewModel::getRatingAVG($product_id);
        if($avg >= 1 && $avg <= 1)
        {
            return 20;
        } else if($avg >= 1 && $avg <= 2)
        {
            return 40;
        }
        else if($avg >= 1 && $avg <= 3)
        {
            return 60;
        }
        else if($avg >= 1 && $avg <= 4)
        {
            return 80;
        }
        else if($avg >= 1 && $avg <= 5)
        {
            return 100;
        } else{
            return 0;
        }
    }
}