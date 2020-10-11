<?php

namespace App\Models;

use App\Scopes\MonthScope;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $url
 * @property string $tag_name
 * @property Carbon $released_at
 *
 * @method static QueryBuilder thisMonth()
 * @method static QueryBuilder lastMonth()
 */
class Release extends Model
{
    use HasFactory;

    protected $table = 'releases';

    protected $casts = [
        'released_at' => 'datetime',
    ];

    protected $fillable = [
        'url',
        'tag_name',
        'released_at',
    ];

    public function scopeThisMonth(QueryBuilder $query): QueryBuilder
    {
        return $query->where('released_at', '>=', Carbon::now()->startOfMonth()->toDateString());
    }

    public function scopeLastMonth(QueryBuilder $query): QueryBuilder
    {
        $lastMonth = Carbon::now()->subMonth();

        return $query->whereBetween(
            'released_at',
            [$lastMonth->startOfMonth()->toDateString(), $lastMonth->endOfMonth()->toDateString()]
        );
    }
}
