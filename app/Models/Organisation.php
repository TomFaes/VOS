<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'Organisation';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name', 'Street', 'PostalCode', 'City', 'SecretariaatTel', 'ClbTel', 'Latitutde', 'Longitude'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function preventieAdviseur()
    {
        return $this->belongsTo('App\Models\User', 'PreventieAdviseurId', 'Id');
    }

    protected $appends = ['Display'];

    public function getDisplayAttribute(){
        return $this->Name;
    }
}
