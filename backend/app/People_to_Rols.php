<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class People_to_Rols extends Model
{
    protected $table= "people_to_rols";
    public $primaryKey="rel_id";
    public $timestamps= false;

    protected $fillable=[
    	'person_id','rol_id','event_id'
    ];

    protected function deleteAllByEventID($id){
        if(isset($id) && $id!=0){
            DB::delete('DELETE FROM '.$this->table.' WHERE event_id = '.$id);
        }
    }

    protected function getRelsQtyByEventId($id){
    	if(isset($id) && $id!=0){
    		return DB::select('SELECT COUNT(rel_id) AS total FROM '.$this-table.' WHERE event_id = '.$id);
    	}
    }

    protected function getPeopleToRolsByEventID($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT p2r.*,p.firstname,p.lastname FROM '.$this->table.' p2r LEFT JOIN people p ON p.person_id=p2r.person_id WHERE event_id = '.$id);
        }
    }

    protected function countCastingByEventID($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(rel_id) AS total FROM '.$this->table.' WHERE event_id = '.$id)[0]->total ;
        }
    }
}
