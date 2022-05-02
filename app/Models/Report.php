<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $guarded = false;

    public function dictionary() {
        return $this->belongsTo(Dictionary::class, 'dictionary_id', 'id');
    }
}
