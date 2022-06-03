<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    use HasFactory;

    // public $status = '' ;

    protected $fillable = [

        'title',
        'description',
        'start_date',
        'end_date'
    ] ;

    protected $dates = [

        'start_date',
        'end_date',
    ] ;

    protected $appends = [

        'status'
    ] ;

    public function options()
    {

        return $this->hasMany(Option::class) ;
    }

    public function getStatusAttribute(){

        $today = Carbon::now()->subHours(3) ;
        $start = Carbon::parse($this->attributes['start_date']) ;
        $end = Carbon::parse($this->attributes['end_date']) ;

        $status = $today->gte($start) ? ($today->gt($end) ? 'ENDED' : 'STARTED'): 'NOT-STARTED' ;

        return $status ;
    }
}
