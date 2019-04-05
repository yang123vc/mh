<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartoon_list extends Model
{

    public $timestamps=false;
    public $table='cartoon_list';
    public  $guarded=[];
//    public function getUrlAttribute($key)
//    {
//
//      $url =  explode(',',trim($key))? : [trim($key)];
//      return $url;
//    }


//    public function cartoon()
//    {
//        return $this->hasOne(Cartoon::class,'id','cartoon_id');
//    }

    public function cartoon()
    {
        return $this->belongsTo(Cartoon::class,'cartoon_id','id');
    }




}
