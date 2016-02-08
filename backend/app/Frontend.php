<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;

class Frontend extends Model
{
   protected $table= "events";
    // tables
    protected $table_dates="event_dates";
    protected $table_p2r="people_to_rols";
    protected $table_people="people";
    protected $table_rols="rols";
    protected $table_c2e="category_to_events";
    protected $table_company="companies";
    protected $table_category="categories";
    protected $table_venues="venues";
    protected $table_reviews="reviews";

    // model data
    protected $primaryKey="event_id";
    public $timestamps= true;

    // function for FRONTEND
    protected function getEventsByWeek($week,$start_at=0,$limit=15){
        if(isset($week)){
            $select="e.event_id, e.title, e.friendly_url, e.poster, ed.date_start, ed.hour_start, ed.hour_end, v.name as venue_name, v.friendly_url as venue_friendly_url";
            // db query
            $sql="SELECT ".$select." FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id WHERE ed.date_start BETWEEN '".$week['start']."' AND '".$week['end']."' AND e.status=1 AND ed.status=1 ORDER BY e.priority DESC,ed.date_start,ed.hour_start ASC ";
            if($start_at > 0){
                $start_at=($start_at-1) * $limit;
                $sql.=' LIMIT '.$start_at.', '.$limit;
            }
            $result=DB::select($sql);
            if(!empty($result)){
                // add DAY NAME
                foreach($result as $item){
                    $item->dayname=$this->getDayName($item->date_start);
                }
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //obtiene la friendly_url del evento
    protected function getEventByFriendly_url($url,$date_start=false){
        if($date_start==false){
            $date_start=date("Y-m-d H:i:s");
        }
        if(isset($url)){
            $sql="SELECT e.*, ed.*, co.name as company, co.friendly_url as company_url FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_company." co ON co.company_id=e.company_id WHERE e.friendly_url = '".$url."' AND ed.date_start = '".$date_start."' AND e.status=1 AND ed.status=1 LIMIT 1";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0];
            }else{
                return false;
            }
        }
    }

    // Obtiene la información del lugar.
    protected function getVenueByID($id){
        if(isset($id)){
            $sql="SELECT * FROM ".$this->table_venues." WHERE venue_id = '".$id."' LIMIT 1";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0];
            }else{
                return false;
            }
        }
    }

    // obtiene las categorías del evento.
    protected function getCategoriesByEventID($id){
        if(isset($id)){
            $sql="SELECT c.category_id, c.name FROM ".$this->table_c2e." ce LEFT JOIN ".$this->table_category." c ON c.category_id=ce.category_id WHERE ce.event_id = '".$id."' AND c.status=1";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }
    }

    // Obtiene el staff(Personas y roles) del evento
    protected function getPeopleAndRolsByEventID($id){
        if(isset($id)){
            $sql="SELECT r.name as rol, p.firstname, p.lastname FROM ".$this->table_p2r." p2r LEFT JOIN ".$this->table_people." p ON p.person_id=p2r.person_id LEFT JOIN ".$this->table_rols." r ON r.rol_id=p2r.rol_id WHERE event_id = '".$id."' AND p.status=1";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }
    }

    // Cuenta la cantidad de eventos de la semana
    protected function countEventsByWeek($week){
        if(isset($week)){
            $sql="SELECT COUNT(e.event_id) AS total FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id WHERE ed.date_start BETWEEN '".$week['start']->format("Y-m-d")." 00:00:00' AND '".$week['end']->format("Y-m-d")." 23:59:59' AND e.status=1 AND ed.status=1 ORDER BY ed.date_start ASC ";
            return DB::select($sql)[0]->total;
        }
    }

    // trae las fechas de los eventos por el id del evento.
    protected function getEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT * FROM ".$this->table_dates." WHERE event_id = ".$id." ORDER BY date_start,hour_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // trae las fechas de los eventos por el id del evento.
    protected function countEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT COUNT(eventdate_id) as total FROM ".$this->table_dates." WHERE event_id = ".$id." ORDER BY date_start,hour_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0]->total;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // cuento todas las fechas que faltan.
    protected function countIncomingEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT count(eventdate_id) as total FROM ".$this->table_dates." WHERE event_id = ".$id." AND date_start > '".date('Y-m-d H:i:s')."' ORDER BY date_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0]->total;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // trae las fechas de los eventos por el id del evento.
    protected function getIncomingEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT * FROM ".$this->table_dates." WHERE event_id = ".$id." AND date_start > '".date('Y-m-d H:i:s')."' ORDER BY date_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // trae las fechas de los eventos por el id del evento.
    protected function getPassedEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT * FROM ".$this->table_dates." WHERE event_id = ".$id." AND date_start < '".date('Y-m-d H:i:s')."' ORDER BY date_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // cuento todas las fechas que faltan.
    protected function countPassedEventsDatesByEventID($id){
        if(isset($id)){
            $sql="SELECT count(eventdate_id) as total FROM ".$this->table_dates." WHERE event_id = ".$id." AND date_start < '".date('Y-m-d H:i:s')."' ORDER BY date_start ASC";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0]->total;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // trae eventos random. Por la fecha actual(EL DIA DE HOY) y un límite
    protected function getRandomEventsByDate($limit){
        if(isset($limit)){
            $select="e.event_id, e.title, e.friendly_url, e.poster, ed.date_start, ed.hour_start, ed.hour_end, v.name as venue_name, v.friendly_url as venue_friendly_url";
            // db query
            //$sql="SELECT ".$select." FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id WHERE ed.date_start < '".$date."' AND e.status=1 AND ed.status=1 AND ed.date_start >= '".date('Y-m-d')."' ORDER BY RAND() ASC LIMIT ".$limit;
            $sql="SELECT ".$select." FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id WHERE ed.date_start > '".date("Y-m-d")." 00:00:00' AND e.status=1 AND ed.status=1 ORDER BY RAND() ASC LIMIT ".$limit;
            $result=DB::select($sql);
            if(!empty($result)){
                // add DAY NAME
                foreach($result as $item){
                    $item->dayname=$this->getDayName($item->date_start);
                }
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // Cuenta la cantidad de eventos disponibles para mostrar.
    protected function countRandomEventsByDate($date){
        if(isset($date)){
            // db query
            $sql="SELECT count(event_id) as total FROM ".$this->table_dates." WHERE date_start < '".$date."' AND status=1 AND hour_start < '".date('H:i')."' ORDER BY RAND() ASC ";
            $result=DB::select($sql);
            if(!empty($result)){
                return $result[0]->total;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // traigo los comentarios del evento
    protected function getReviewsByEventID($id){
        if(isset($id)){
            $sql="SELECT * FROM ".$this->table_reviews." WHERE event_id = ".$id." AND status=1 ORDER BY created_at DESC ";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // traigo los comentarios del evento
    protected function getReviewsRatingByEventID($id){
        if(isset($id)){
            $sql="SELECT COUNT(review_id) as total ,SUM(rating) as rating FROM ".$this->table_reviews." WHERE event_id = ".$id." AND status=1 ";
            $result= DB::select($sql);
            if(!empty($result)){
                if($result[0]->total > 0){
                    return $result[0]->rating / $result[0]->total;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // cuenta las opiniores recibidas
    protected function countReviewsByEventID($id){
        if(isset($id)){
            $sql="SELECT COUNT(review_id) as total FROM ".$this->table_reviews." WHERE event_id = ".$id." AND status=1 ";
            $result= DB::select($sql);
            if(!empty($result)){
                return $result[0]->total;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    // get day name
    public function getDayName($date){
        $date=new DateTime($date);
        switch($date->format("N")){
            case 1:
                return "Lunes";
            break;
            case 2:
                return "Martes";
            break;
            case 3:
                return "Miércoles";
            break;
            case 4:
                return "Jueves";
            break;
            case 5:
                return "Viernes";
            break;
            case 6:
                return "Sábado";
            break;
            case 7:
                return "Domingo";
            break;
        }
    }

    protected function getVenueByFriendly_url($url){
        if(isset($url)){
            $sql="SELECT * FROM ".$this->table_venues." WHERE friendly_url = '".$url."' LIMIT 1";
            $result=DB::select($sql);
            if(!empty($result)){
                return $result[0];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

        protected function getCompanyByFriendly_url($url){
        if(isset($url)){
            $sql="SELECT * FROM ".$this->table_company." WHERE friendly_url = '".$url."' LIMIT 1";
            $result=DB::select($sql);
            if(!empty($result)){
                return $result[0];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // traigo los eventos del MES (de principio a fin. de la sala o compañía)
    protected function getEventsByTypeID($type,$id,$date){
        
        if(isset($id)){
            $select="e.event_id, e.title, e.friendly_url, e.poster, ed.date_start, ed.hour_start, ed.hour_end, v.name as venue_name, v.friendly_url as venue_friendly_url";
            // db query
            $sql="SELECT ".$select." FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id WHERE ed.date_start BETWEEN '".$date['start']."' AND '".$date['end']."' AND e.".$type."_id= '".$id."' AND e.status=1 AND ed.status=1  GROUP BY e.event_id ORDER BY ed.date_start,ed.hour_start ASC ";
            $result=DB::select($sql);
            if(!empty($result)){
                // add DAY NAME
                foreach($result as $item){
                    $item->dayname=$this->getDayName($item->date_start);
                }
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    // devolverá una lista con NOMBRE, LINK, FECHAS (Si las tiene) y TIPO (EVENTO, GRUPO, CATEGORÍA, SALA)
    protected function search($query){
        // busco en eventos
        $sql="SELECT e.title as name, e.friendly_url, ed.date_start, e.created_at FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id WHERE e.title LIKE '%".$query."%' AND e.status=1 AND ed.status=1 GROUP BY e.event_id ORDER BY e.priority DESC, ed.date_start DESC";
        $results['events']=DB::select($sql);
        // busco en categorías
        $sql="SELECT name, category_id, created_at FROM ".$this->table_category." WHERE name LIKE '%".$query."%' AND status=1 ORDER BY name ASC";
        $results['categories']=DB::select($sql);
        // busco en grupos
        $sql="SELECT name, friendly_url, created_at FROM ".$this->table_company." WHERE name LIKE '%".$query."%' AND status=1 ORDER BY name ASC";
        $results['companies']=DB::select($sql);
        // busco en salas
        $sql="SELECT name, friendly_url, created_at FROM ".$this->table_venues." WHERE name LIKE '%".$query."%' AND status=1 ORDER BY name ASC";
        $results['venues']=DB::select($sql);
        // count
        $total=count($results['events'])+count($results['categories'])+count($results['companies'])+count($results['venues']);
        $results['total']=$total;
        return $results;
    }

    // traigo los eventos de las categorías cuando la prioridad mayor a cero
    protected function getEventsByCategory($id,$start_at,$limit){
        $select="e.event_id, e.title, e.friendly_url, e.poster, ed.date_start, ed.hour_start, ed.hour_end, v.name as venue_name, v.friendly_url as venue_friendly_url";
        $sql="SELECT ".$select." FROM ".$this->table." e LEFT JOIN ".$this->table_dates." ed ON ed.event_id=e.event_id LEFT JOIN ".$this->table_venues." v ON v.venue_id=e.venue_id LEFT JOIN ".$this->table_c2e." c2e ON c2e.event_id=e.event_id WHERE c2e.category_id='".$id."' AND ed.status=1 AND e.status=1 AND e.priority > 0 GROUP BY e.event_id ORDER BY e.priority DESC, ed.date_start,ed.hour_start ASC ";
        if($start_at > 0){
            $start_at=($start_at-1) * $limit;
            $sql.=' LIMIT '.$start_at.', '.$limit;
        }
        $result=DB::select($sql);
        if(!empty($result)){
            // add DAY NAME
            foreach($result as $item){
                $item->dayname=$this->getDayName($item->date_start);
            }
            return $result;
        }else{
            return false;
        }
    }

    protected function countEventsByCategory($id){
        $sql="SELECT COUNT(e.event_id) AS total FROM ".$this->table." e  LEFT JOIN ".$this->table_c2e." c2e ON c2e.event_id=e.event_id WHERE c2e.category_id='".$id."' AND e.status=1 AND e.priority > 0  GROUP BY e.event_id ";
        $result=DB::select($sql);
        if(!empty($result)){
            return $result[0]->total;
        }else{
            return false;
        }
    }

    protected function getCategories(){
        $sql="SELECT * FROM ".$this->table_category." ORDER BY name ASC ";
        $result=DB::select($sql);
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

}
