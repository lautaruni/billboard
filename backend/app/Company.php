<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model
{
    protected $table= "companies";
    protected $primaryKey="company_id";
    public $timestamps= true;
    protected $fillable=[
    	'name','friendly_url','image','description','phone','web','email','status'
    ];

    protected function getCompanies(){
        $query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table);
        $result=array();
        foreach($query as $item){
            $result[$item->company_id]=$item->name;
        }
        return $result;
    }

     protected function getImage($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT image FROM '.$this->table.' WHERE '.$this->primaryKey.' = '.$id)[0]->image ;
        }
    }

}
