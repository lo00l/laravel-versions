<?php

namespace App\Support;

use App\Contracts\ReleaseFetcherInterface;
use App\Exceptions\ReleaseFetchException;
use Github\Client as GithubClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class GithubReleaseFetcher implements ReleaseFetcherInterface
{
    /**
     * @inheritDoc
     */
    public function fetchReleases(string $repository): array
    {
        $repositoryData = explode('/', $repository);

        if (count($repositoryData) !== 2) {
            throw new ReleaseFetchException('Bad repository name.');
        }

        $client = new GithubClient();

        $releases = $client->repos()->releases()->all('laravel', 'framework');

        return collect($releases)
            ->filter(static fn (array $releaseData): bool => preg_match(
                '/v\d+\.\d+\.0/',
                Arr::get($releaseData, 'tag_name', '')
            ))
            ->map(static fn (array $releaseData): Release => new Release(
                Arr::get($releaseData, 'html_url'),
                Arr::get($releaseData, 'tag_name'),
                Carbon::parse(Arr::get($releaseData, 'created_at')),
            ))
            ->all();
    }
}
