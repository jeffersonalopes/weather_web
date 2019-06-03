<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class City extends Eloquent
{

    protected $connection = 'mongodb';
    protected $fillable = ["active","api_id",'display_name','day','rainy_day','cloudy_day','cloudy_night','rainy_night','night','api_name','country','coords'];
    protected $collection  = "cities";
}
