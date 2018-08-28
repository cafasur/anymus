<?php

namespace App;

use App\Traits\DatesTranslator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AbsenteeismControl extends Model
{
    use DatesTranslator;

    protected $table = 'absenteeism_control';

    public function getPermissionDateAttribute($value)
    {
        return new Carbon($value);
    }

    public function getArrivalDateAttribute($value)
    {
        return new Carbon($value);
    }

    public function absenteeism_type(){
        return $this->belongsTo('App\AbsenteeismType');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function status(){
        return $this->belongsTo('App\AbsenteeismState');
    }
}
