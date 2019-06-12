<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedureType extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'ProcedureType';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name', 'Image'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['ImageLink', 'Display'];

    public function getImageLinkAttribute(){
        return asset('files/procedure-types/'.$this->Image);
    }

    public function getDisplayAttribute(){
        return $this->Name;
    }
}
