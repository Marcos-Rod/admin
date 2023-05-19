<?php

namespace App\Models;

class Image extends Model
{
    protected $table = 'images';

    public function updateImage($id, $data){
        return $this->update($id, $data);
    }
}