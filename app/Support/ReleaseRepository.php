<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Release;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ReleaseRepository
{
    public function getThisMonthReleases(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('this'),
            $this->getMonthEndDiff(),
            static fn (): Collection => Release::thisMonth()->get()
        );
    }

    public function getThisMonthReleasesCount(): int
    {
        return Cache::remember(
            $this->getCacheKey('this_count'),
            $this->getMonthEndDiff(),
            static fn (): int => Release::thisMonth()->count()
        );
    }

    public function getLastMonthReleases(): Collection
    {
        return Cache::remember(
            $this->getCacheKey('last'),
            $this->getMonthEndDiff(),
            static fn (): Collection => Release::lastMonth()->get()
        );
    }

    public function getLastMonthReleasesCount(): int
    {
        return Cache::remember(
            $this->getCacheKey('last_count'),
            $this->getMonthEndDiff(),
            static fn (): int => Release::lastMonth()->count()
        );
    }

    protected function getCacheKey(string $month): string
    {
        return "releases_month_{$month}";
    }

    protected function getMonthEndDiff(): DateInterval
    {
        return Carbon::now()->diff(Carbon::now()->endOfMonth());
    }
}
