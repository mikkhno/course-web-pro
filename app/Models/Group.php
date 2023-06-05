<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $table = 'groups';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function level()
    {
        return $this->belongsTo(LanguageLevel::class, 'level_id');
    }

    public function type()
    {
        return $this->belongsTo(GroupType::class, 'id_type');
    }

    public function schedules()
    {
        return $this->hasMany(AllSchedule::class, 'group_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'groups_list', 'group_id', 'user_id');
    }
}
