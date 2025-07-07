<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Province extends Model
{
    use HasTranslations;

    public  $translatable = ['name'];
    protected $guarded = [];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
