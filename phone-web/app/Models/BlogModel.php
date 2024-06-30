<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class BlogModel extends Model
{
    use HasFactory;
    protected $table = 'blog';

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getSingleSlug($slug){
        return self::where('slug','=', $slug)
            ->where('blog.status', '=', 0)
            ->where('blog.is_delete', '=', 0)
            ->first();
    }

    static public function getRecord(){
        return self::select('blog.*')
            ->where('blog.is_delete', '=', 0)
            ->orderBy('blog.id', 'desc')
            ->paginate(20);
    }

    static public function getRecordActive(){
        return self::select('blog.*')
            ->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->orderBy('blog.name', 'asc')
            ->get();
    }
    
    static public function getRecordActiveHome(){
        return self::select('blog.*')
            ->where('blog.is_delete', '=', 0)
            ->where('blog.status', '=', 0)
            ->limit(3)
            ->orderBy('blog.id', 'asc')
            ->get();
    }

    public function getImage(){
        if(!empty($this->image_name) && file_exists('upload/blog/'.$this->image_name)){
            return url('upload/blog/'.$this->image_name);
        }
        else{
            return "";
        }
    }

    static public function getBlog($blog_category_id = ''){
        $return = self::select('blog.*');
        if(!empty(Request::get('search'))){
            $return = $return->where('blog.title', 'like', '%'.Request::get('search').'%');
        }
        if(!empty($blog_category_id)){
            $return = $return->where('blog.blog_category_id', '=', $blog_category_id);
        }
        $return = $return->where('blog.is_delete', '=', 0)
                        ->where('blog.status', '=', 0)
                        ->orderBy('blog.id', 'desc')
                        ->paginate(20);
        return $return;
    }

    static public function getPopular(){
        $return = self::select('blog.*');
        $return = $return->where('blog.is_delete', '=', 0)
                        ->where('blog.status', '=', 0)
                        ->orderBy('blog.total_view', 'desc')
                        ->limit(6)
                        ->get();
        return $return;
    }

    static public function getRelatedPost($blog_category_id, $blog_id){
        $return = self::select('blog.*');
        $return = $return->where('blog.is_delete', '=', 0)
                        ->where('blog.blog_category_id', '=', $blog_category_id)
                        ->where('blog.id', '!=', $blog_id)
                        ->where('blog.status', '=', 0)
                        ->orderBy('blog.total_view', 'desc')
                        ->limit(6)
                        ->get();
        return $return;
    }
    

    public function getCategory(){
        return $this->belongsTo(BlogCategoryModel::class, 'blog_category_id');
    }

    public function getComment(){
        return $this->hasMany(BlogCommentModel::class, 'blog_id')
                    ->select('blog_comment.*')
                    ->join('users', 'users.id', '=', 'blog_comment.user_id')
                    ->orderBy('blog_comment.id', 'desc');
    }

    public function getCommentCount(){
        return $this->hasMany(BlogCommentModel::class, 'blog_id')
                    ->select('blog_comment.id')
                    ->join('users', 'users.id', '=', 'blog_comment.user_id')
                    ->count();
    }
}
