<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'genre', 'platform', 'description'])]
class Game extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status', 'rating', 'notes');
    }
}
