<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Event extends Model
{
    protected $table= "events";
    protected $primaryKey="event_id";
    public $timestamps= true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'friendly_url', 'poster','description','mature','price','quota','priority','status','company_id','venue_id'
    ];

    public function setDescriptionAttribute($val){
        if(!empty($val)){
            $this->attributes['description']=htmlentities($val);
        }
    }

    protected function getLastID(){
        return DB::getPdo()->lastInsertId();
    }

    public function company($id){
        if(isset($id)){
            return Company::find($id);
        }
    }

    public function venue($id){
        if(isset($id)){
            return Venue::find($id);
        }
    }

    public function person($id){
        if(isset($id)){
            return Person::find($id);
        }
    }

    public function rol($id){
        if(isset($id)){
            return Rol::find($id);
        }
    }

    public function countCasting($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(rel_id) AS total FROM people_to_rols WHERE event_id = '.$id)[0]->total ;
        }
    }

    public function countDates($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(eventdate_id) AS total FROM event_dates WHERE event_id = '.$id.' AND status=1 ')[0]->total ;
        }
    }

    public function countCategories($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT COUNT(rel_id) AS total FROM category_to_events WHERE event_id = '.$id)[0]->total ;
        }
    }

     protected function getImage($id){
        if(isset($id) && $id!=0){
            return DB::select('SELECT poster FROM '.$this->table.' WHERE event_id = '.$id)[0]->poster ;
        }
    }

    protected function specialGet($id){
        
    }

    // get remaining dates

    public function getRemainingDates($id){
        if(isset($id)){
            $sql='SELECT COUNT(ed.eventdate_id) as total FROM '.$this->table.' e LEFT JOIN event_dates ed ON ed.event_id=e.event_id WHERE e.event_id='.$id.' AND ed.date_start > "'.date("Y-m-d H:i:s").'" ORDER BY ed.date_start ASC';
            return DB::select($sql)[0]->total;
        }
    }

}
