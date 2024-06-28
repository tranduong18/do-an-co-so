<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getImage(){
        if(!empty($this->image_name) && file_exists('upload/blog/'.$this->image_name)){
            return url('upload/blog/'.$this->image_name);
        }
        else{
            return "";
        }
    }
}
