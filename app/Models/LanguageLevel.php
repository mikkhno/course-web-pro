<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageLevel extends Model
{
    use HasFactory;
    protected $table = 'lang_level';

    public function groups()
    {
        return $this->hasMany(Group::class, 'level_id');
    }
}
