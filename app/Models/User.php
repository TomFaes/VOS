<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    public static $snakeAttributes = false;
    use HasApiTokens, Notifiable;

    protected $table = 'User';
    protected $primaryKey = 'Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'Name', 'Email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'remember_token', 'GoogleId'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'RoleId', 'Id');
    }
    public function typeAccount()
    {
        return $this->belongsTo('App\Models\TypeAccount', 'TypeAccountId', 'Id');
    }
    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'PositionId', 'Id');
    }

    protected $appends = ['Display'];
    public function getDisplayAttribute(){
        return $this->FirstName." ".$this->Name;
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }

}
