<?php

namespace App;

use App\Traits\DatesTranslator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AbsenteeismControl extends Model
{
    use DatesTranslator;

    protected $status = [
       'Sin aprobar',
       'Rechazado',
       'Aprobado',
       'Finalizado'
    ];

    protected $table = 'absenteeism_control';

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
