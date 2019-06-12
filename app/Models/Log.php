<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public static $snakeAttributes = false;

    protected $table = 'Log';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'UserName', 'Email', 'Role', 'ProcedureCode', 'ProcedureTitle', 'StepTitle', 'Action', 'CallingNumber', 'SendNumber'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
