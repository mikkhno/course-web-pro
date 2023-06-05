<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    use HasFactory;
    protected $table = 'group_type';

    public function groups()
    {
        return $this->hasMany(Group::class, 'id_type');
    }
}
