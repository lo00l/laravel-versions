<?php

namespace App\DTO;

use Illuminate\Support\Carbon;

class Release
{
    protected string $url;

    protected string $tagName;

    protected Carbon $releaseDate;

    /**
     * @param string $url
     * @param string $tagName
     * @param Carbon $releaseDate
     */
    public function __construct(string $url, string $tagName, Carbon $releaseDate)
    {
        $this->url = $url;
        $this->tagName = $tagName;
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     * @return Carbon
     */
    public function getReleaseDate(): Carbon
    {
        return $this->releaseDate;
    }
}
