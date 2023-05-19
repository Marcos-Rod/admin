<?php

namespace App\Models;

use App\Functions;

trait Relations {
   public function morphOne($related, $name, $id, $url, $table){
      $this->table = $table;
      $this->fillable = ['url', $name . '_id', $name . '_type'];
      $data = [
         'url' => $url,
         $name . '_id' => $id,
         $name . '_type' => $related
      ];

      return $this->create($data);

   }

   public function hasOne($name, $table, $values ){
      $this->table = $table;
      $this->fillable = [$name[0] . '_id', $name[1] . '_id'];

      $data = [
         $name[0] . '_id' => $values[0],
         $name[1] . '_id' => $values[1]
      ];

      return $this->create($data);
   }
}