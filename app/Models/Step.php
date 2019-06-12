<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'Step';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Type', 'Title'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function contactSms()
    {
        return $this->belongsTo('App\Models\User', 'ContactIdSms', 'Id');
    }

    public function contactPhone()
    {
        return $this->belongsTo('App\Models\User', 'ContactIdPhoneNumber', 'Id');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Models\Procedure', 'ProcedureId', 'Id');
    }

    public function steplist(){
        return $this->hasMany('App\Models\StepList', 'StepId', 'Id');
    }

    protected $appends = ['Display'];

    public function getDisplayAttribute(){
        return $this->Title;
    }

}
