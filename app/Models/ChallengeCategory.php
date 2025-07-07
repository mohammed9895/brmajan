<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ChallengeCategory extends Model
{
    use HasTranslations;

    public  $translatable = ['name'];
    protected $guarded = [];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
