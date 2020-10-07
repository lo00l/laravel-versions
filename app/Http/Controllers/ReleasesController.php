<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Support\ReleaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class ReleasesController extends Controller
{
    public function index(ReleaseRepository $repository)
    {
        return view(
            'index',
            [
                'releases' => $repository->getThisMonthReleases(),
                'lastMonthCount' => $repository->getLastMonthReleasesCount(),
            ]
        );
    }

    public function last(ReleaseRepository $repository)
    {
        return view(
            'last_month',
            [
                'releases' => $repository->getLastMonthReleases(),
                'thisMonthCount' => $repository->getThisMonthReleasesCount(),
            ]
        );
    }
}
