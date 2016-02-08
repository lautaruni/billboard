<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category_to_Event extends Model
{
    protected $table= "category_to_events";
    protected $primaryKey="rel_id";
    public $timestamps= false;

    protected $fillable=[
    	'category_id','event_id'
    ];

    protected function deleteAllRelByEventId($id){
    	if(isset($id) && $id!=0){
    		DB::delete('DELETE FROM '.$this->table.' WHERE event_id = '.$id);
    	}
    }

    protected function getAllRelByEventID($id){
    	if(isset($id) && $id!=0){
    		return DB::select('SELECT * FROM '.$this->table.' WHERE event_id = '.$id);
    	}
    }

    protected function countCategoriesByEventID($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(rel_id) AS total FROM '.$this->table.' WHERE event_id = '.$id)[0]->total ;
        }
    }
}
