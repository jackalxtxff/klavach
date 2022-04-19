<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    use HasFactory;

    protected $table = 'stats';
    protected $guarded = false;

    public function dictionary() {
        return $this->belongsTo(Dictionary::class);
    }
}
