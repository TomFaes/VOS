<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAccount extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'TypeAccount';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = ['Display'];

    public function getDisplayAttribute(){
        return $this->Name;
    }
}
