<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'Role';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Name', 'Title'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];


    protected $appends = ['Display'];

    public function getDisplayAttribute(){
        return $this->Name;
    }



}
