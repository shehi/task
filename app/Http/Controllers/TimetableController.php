<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TimetableRequest;
use App\Models\Timetable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class TimetableController extends Controller
{
    public function index(Request $request): View
    {
        $items = Timetable::query()->whereUserId($request->user()->id)->orderByDesc('id')->get();

        return view('timetable', ['items' => $items, 'editedItem' => null]);
    }

    public function store(TimetableRequest $request): RedirectResponse
    {
        $timetable = new Timetable();
        $timetable->user_id = $request->user()->id;
        if ($request->has('started_at')) {
            $timetable->started_at = $request->filled('started_at') ? $request->get('started_at') : new Carbon();
        }
        if ($request->has('ended_at')) {
            $timetable->ended_at = $request->filled('ended_at') ? $request->get('ended_at') : new Carbon();
        }
        $timetable->save();

        return response()->redirectToRoute('timetable.index');
    }

    public function edit(Request $request, Timetable $timetable): View
    {
        $tt = Timetable::query()->whereUserId($request->user()->id)->orderByDesc('id')->get();

        return view('timetable', ['items' => $tt, 'editedItem' => $timetable]);
    }

    public function update(Request $request, Timetable $timetable): RedirectResponse
    {
        if ($request->has('started_at')) {
            $timetable->started_at = $request->filled('started_at') ? $request->get('started_at') : new Carbon();
        }
        if ($request->has('ended_at')) {
            $timetable->ended_at = $request->filled('ended_at') ? $request->get('ended_at') : new Carbon();
        }
        $timetable->save();

        return response()->redirectToRoute('timetable.index');
    }

    public function destroy(Request $request, Timetable $timetable): RedirectResponse
    {
        if ($timetable->user_id === $request->user()->id) {
            $timetable->delete();
        }

        return response()->redirectToRoute('timetable.index');
    }
}
