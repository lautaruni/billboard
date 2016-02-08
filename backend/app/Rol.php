<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Rol extends Model
{
    protected $table= "rols";
    public $primaryKey="rol_id";
    public $timestamps= true;

    public $fillable=[
    	'name'
    ];

    protected function getRols(){
    	$query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table);
        $result=array();
        foreach($query as $item){
            $result[$item->rol_id]=$item->name;
        }
        return $result;
    }
}
