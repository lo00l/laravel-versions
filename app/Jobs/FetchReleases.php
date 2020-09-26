<?php

namespace App\Jobs;

use App\Contracts\ReleaseFetcherInterface;
use App\Exceptions\ReleaseFetchException;
use App\Support\Release;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Release as DbRelease;
use Illuminate\Support\Facades\Log;

class FetchReleases implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * ReleaseFetcherInterface $releaseFetcher
     *
     * @return void
     *
     * @throws ReleaseFetchException
     */
    public function handle(ReleaseFetcherInterface $releaseFetcher): void
    {
        Log::info('Started fetch releases job.');

        try {
            $releases = $releaseFetcher->fetchReleases('laravel/framework');
            collect($releases)
                ->each(static function (Release $release) {
                    if (DbRelease::query()->where('tag_name', $release->getTagName())->exists()) {
                        return false;
                    }

                    DbRelease::query()->create([
                        'url' => $release->getUrl(),
                        'tag_name' => $release->getTagName(),
                        'released_at' => $release->getReleaseDate(),
                    ]);
                });

            Log::info('Finished fetch releases job.');
        } catch (ReleaseFetchException $e) {
            Log::error("Failed to fetch releases: {$e->getMessage()}");

            throw $e;
        }
    }
}
