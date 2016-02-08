<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Person extends Model
{
    protected $table= "people";
    public $primaryKey="person_id";
    public $timestamps= true;

    public $fillable=[
    	'user_id','firstname', 'lastname','status'
    ];

    protected function getPeople(){
        return DB::select('SELECT '.$this->primaryKey.', firstname, lastname FROM '.$this->table.' ');
    }

    protected function getPersonByName($firstname,$lastname){
    	return DB::select('SELECT * FROM '.$this->table.' WHERE firstname LIKE "'.$firstname.'" AND lastname LIKE "'.$lastname.'" LIMIT 1');
    }

    protected function getLastID(){
        return DB::getPdo()->lastInsertId();
    }

    public function setFirstnameAttribute($val){
        if(!empty($val)){
            $this->attributes['firstname']=ucfirst(strtolower($val));
        }
    }

    public function setLastnameAttribute($val){
        if(!empty($val)){
            $this->attributes['lastname']=ucfirst(strtolower($val));
        }
    }
    
}
