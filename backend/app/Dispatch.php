<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $table= "dispatches";
    protected $primaryKey="dispatch_id";
    public $timestamps= true;
    protected $fillable = [
        'title', 'friendly_url', 'poster','description','mature','price','quota','priority','status','company','venue_id','venue_alt','contact_name','contact_social','cast','eventdates'
    ];
}
