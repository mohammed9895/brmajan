<?php

namespace App\Models;

use App\Enums\ParticipantStatus;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded  = [];

    protected $casts = [
        'status' => ParticipantStatus::class,
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
