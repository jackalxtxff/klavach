<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excerpt extends Model
{
    use HasFactory;

    protected $table = 'excerpts';
    protected $guarded = false;

    public function dictionary() {
        return $this->belongsTo(Dictionary::class);
    }
}
