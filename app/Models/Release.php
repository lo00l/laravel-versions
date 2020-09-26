<?php

namespace App\Models;

use App\Scopes\MonthScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $url
 * @property string $tag_name
 * @property Carbon $released_at
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

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new MonthScope());
    }
}
