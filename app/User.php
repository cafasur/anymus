<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'unit_id', 'status_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function unit(){
        return $this->belongsTo('App\Unit');
    }

    public function status(){
        return $this->belongsTo('App\UserState');
    }

    public function document_types(){
        return $this->belongsTo('App\DocumentType', 'document_type_id');
    }
}
