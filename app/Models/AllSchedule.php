<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllSchedule extends Model
{
    protected $table = 'allschedules';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
