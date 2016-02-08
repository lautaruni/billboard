<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EventDate extends Model
{
    protected $table= "event_dates";
    public $timestamps= true;

    protected $fillable=[
    	'event_id','date_start','date_end','hour_start','hour_end','status'
    ];

    protected function deleteAllByEventID($id){
    	if(isset($id) && $id!=0){
    		DB::delete('DELETE FROM '.$this->table.' WHERE event_id = '.$id);
    	}
    }

    protected function countDatesByEventID($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(eventdate_id) AS total FROM '.$this->table.' WHERE event_id = '.$id.' AND status=1 ')[0]->total ;
        }
    }

    protected function getEventDatesByEventID($id){
    	if(isset($id) && $id!=0){
    		return DB::select('SELECT * FROM '.$this->table.' WHERE event_id = '.$id);
    	}
    }
}
