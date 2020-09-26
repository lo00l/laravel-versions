<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ReleasesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $releases = Cache::remember(
            $this->getCacheKey(),
            Carbon::now()->endOfMonth()->diff(Carbon::now()),
            static fn (): Collection => Release::query()->get()
        );

        return view(
            'index',
            [
                'releases' => $releases,
            ]
        );
    }

    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        return Carbon::now()->format('releases_%m.Y');
    }
}
