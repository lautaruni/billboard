<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $table= "categories";
    protected $primaryKey="category_id";
    public $timestamps= true;

    public $fillable=[
    	'name','description','parent_id','status'
    ];

    protected function getParents($id=null){
    	return DB::select('SELECT category_id, name FROM '.$this->table.' WHERE NOT parent_id = ":id"', ['id' => $id]);
    }

    protected function getCategories(){
    	$query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table);
        $result=array();
        foreach($query as $item){
            $result[$item->category_id]=$item->name;
        }
        return $result;
    }

    protected function getCategoriesParent($id=0){
        if($id!=0){
            $query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table.' WHERE  '.$this->primaryKey.' != '.$id);
        }else{
            $query=DB::select('SELECT '.$this->primaryKey.', name FROM '.$this->table);
        }
        $result=array();
        $result[0]="--Ninguna--";
        foreach($query as $item){
            $result[$item->category_id]=$item->name;
        }
        return $result;
    }

    public function getParent($id){
        if(isset($id) && $id!=0){
            return $this->find($id);
        }else{
            //return "--Ninguna--";
            $result= new \stdClass;
            $result->name="--Ninguna--";
            return $result;
        }
    }

}
