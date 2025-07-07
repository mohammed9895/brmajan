<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Challenge extends Model
{
    use HasTranslations;

    public  $translatable = ['title', 'description'];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ChallengeCategory::class, 'challenge_category_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
