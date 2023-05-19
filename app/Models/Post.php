<?php

namespace App\Models;



class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['name', 'slug', 'description', 'body', 'keywords', 'status', 'category_id', 'create_at', 'update_at'];

    public function categories(){
        $categoryModel = new Category;
        $categories = $categoryModel->all();

        return $categories;
    }

    public function images($url = "", $id = null){
       return $this->morphOne(Image::class, 'imageable', $id, $url, 'images');
    }
    
}