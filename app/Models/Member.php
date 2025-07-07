<?php

namespace App\Models;

use App\Enums\AttendanceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'attendance_ability' => AttendanceType::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'member_skill')->withTimestamps();
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
