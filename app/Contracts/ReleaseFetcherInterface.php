<?php

namespace App\Contracts;

use App\Exceptions\ReleaseFetchException;

interface ReleaseFetcherInterface
{
    /**
     * @param string $repository
     *
     * @return array
     *
     * @throws ReleaseFetchException
     */
    public function fetchReleases(string $repository): array;
}
