<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TimetableRequest;
use App\Models\Timetable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __invoke(Request $request): View
    {
        $dataByDay = Timetable::query()
            ->selectRaw("DATE_FORMAT(started_at,'%Y-%m-%d') day, count(*) count, sec_to_time(sum(time_to_sec(ended_at) - time_to_sec(started_at))) duration")
            ->whereUserId($request->user()->id)
            ->groupBy('day')
            ->get();

        $dataByMonth = Timetable::query()
            ->selectRaw("DATE_FORMAT(started_at,'%Y-%m') month, count(*) count, sec_to_time(sum(time_to_sec(ended_at) - time_to_sec(started_at))) duration")
            ->whereUserId($request->user()->id)
            ->groupBy('month')
            ->get();

        return view('report', ['itemsDaily' => $dataByDay, 'itemsMonthly' => $dataByMonth]);
    }
}
