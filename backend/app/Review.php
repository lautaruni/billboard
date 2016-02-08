<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table="reviews";
    public $timestamps= true;
    protected $primaryKey="review_id";

    protected $fillable=[
    	'name','comment','rating','event_id','status'
    ];
}
