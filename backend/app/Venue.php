<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Venue extends Model
{
    protected $table= "venues";
    public $timestamps= true;
    public $primaryKey="venue_id";
    protected $fillable=[
    	'name','friendly_url','image','description','phone','web','email','location','coordinates','status'
    ];

    protected function getVenues(){
        $query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table);
        $result=array();
        foreach($query as $item){
            $result[$item->venue_id]=$item->name;
        }
        return $result;
    }
    
     protected function getImage($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT image FROM '.$this->table.' WHERE '.$this->primaryKey.' = '.$id)[0]->image ;
        }
    }

}
