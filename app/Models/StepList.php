<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StepList extends Model
{
    use SoftDeletes;
    public static $snakeAttributes = false;

    protected $table = 'StepList';
    protected $primaryKey = 'Id';

    protected $fillable = [
        'Title', 'Order'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function step()
    {
        return $this->belongsTo('App\Models\Step', 'StepId', 'Id');
    }
}
