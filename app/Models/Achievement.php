<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    /* Achievement types*/
    const COMMENTS = 'comments';
    const LESSONS = 'lessons';


    public function scopeUnattainedByUser($query, $userId): Builder
    {
        return $query->whereDoesntHave('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        });
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
