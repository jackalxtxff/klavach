<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $guarded = false;

    public function dictionaries() {
        return $this->hasMany(Dictionary::class);
    }
}
