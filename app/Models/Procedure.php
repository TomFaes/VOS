<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use SoftDeletes;

    protected $table = 'Procedure';
    protected $primaryKey = 'Id';
    public static $snakeAttributes = false;

    protected $fillable = [
        'Code', 'Title', 'Description', 'Heading', 'Image',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function procedureType()
    {
        return $this->belongsTo('App\Models\ProcedureType', 'ProcedureTypeId', 'Id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'RoleId', 'Id');
    }

    public function steps(){
        return $this->hasMany('App\Models\Step', 'ProcedureId', 'Id');
    }

    protected $appends = ['ImageLink', 'Display'];

    public function getImageLinkAttribute(){
        return asset('files/procedure/'.$this->Image);
    }

    public function getDisplayAttribute(){
        return $this->Title;
    }

}
