<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dictionaries';
    protected $guarded = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type() {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function excerpts() {
        return $this->hasMany(Excerpt::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function games() {
        return $this->hasMany(Game::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function stats() {
        return $this->hasOne(Stats::class);
    }
}
