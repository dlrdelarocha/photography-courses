<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    use HasFactory;

    protected array $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'name', 
        'alias', 
        'achievements_points', 
        'description'
    ];
    
    public $timestamps = true;

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

    public static function getNextBadge(Badge $currentBadge): Badge
    {
        return self::where('achievements_points', '>', $currentBadge->achievements_points)
            ->orderBy('achievements_points', 'asc')
            ->first();
    }

    public static function getBadgesInfo(User $user): array
    {
        $currentBadge =  $user->currentBadge();

        if(empty($currentBadge))  {
            return [
                'currentBadge' => '',
                'nextBadge' => '',
                'pointsNeeded' => '',
            ];
        }

        $nextBadge = self::getNextBadge($currentBadge);

        $pointsNeeded = max(0, $nextBadge->achievements_points - $currentBadge->achievements_points);

        return [
            'currentBadge' => $currentBadge->name,
            'nextBadge' => $nextBadge->name,
            'pointsNeeded' => $pointsNeeded,
        ];
    }
}
