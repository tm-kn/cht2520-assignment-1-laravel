<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterActivity;
use App\Http\Requests\StoreActivity;
use App\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\FilterActivity    $request
     * @return \Illuminate\Http\Response
     */
    public function index(FilterActivity $request)
    {
        $validated = $request->validated();
        $startDate = Carbon::today()->subDays(7);
        if (array_key_exists('start_date', $validated) && $validated['start_date'] !== null) {
            $startDate = new Carbon($validated['start_date']);
        }

        $endDate = Carbon::today();
        if (array_key_exists('end_date', $validated) && $validated['end_date'] !== null) {
            $endDate = new Carbon($validated['end_date']);
        }

        $searchQuery = [];
        if (array_key_exists('search_query', $validated)) {
            $searchQuery = explode(" ", $validated['search_query']);
        }

        $userId = $request->user()->id;

        $startDate->startOfDay();
        $endDate->endOfDay();
        if ($startDate > $endDate) {
            $tmpStartDate = $startDate;
            $startDate = $endDate;
            $endDate = $tmpStartDate;
        }

        $activities = Activity::whereUserId($userId)
            ->orderBy('start_datetime', 'desc')
            ->where('start_datetime', '>=', $startDate->startOfDay())
            ->where('start_datetime', '<=', $endDate->endOfDay());

        if ($searchQuery) {
            $activities->where(function ($query) use ($searchQuery) {
                foreach ($searchQuery as $searchTerm) {
                    $query->orWhere('activity', 'ILIKE', '%' . $searchTerm . '%');
                    $query->orWhere('project', 'ILIKE', '%' . $searchTerm . '%');
                    $query->orWhere('description', 'ILIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return view('activity.index')
            ->withActivities($activities->get())
            ->withFilters([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'search_query' => implode(' ', $searchQuery),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivity  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivity $request)
    {
        $validated = $request->validated();
        $activity = new Activity($validated);
        $activity->user_id = $request->user()->id;
        $activity->save();
        return redirect()->action('ActivityController@index')
                         ->withSuccess(__('Activity created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Activity $activity)
    {
        if ($activity->user != $request->user()) {
            abort(404);
        }
        return view('activity.show')->withActivity($activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Activity $activity)
    {
        if ($activity->user != $request->user()) {
            abort(404);
        }
        return view('activity.edit')->withActivity($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivity  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActivity $request, Activity $activity)
    {
        $validated = $request->validated();
        $activity->fill($validated);
        $activity->save();
        return back()->withSuccess(__('Activity updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        if ($activity->user != $request->user()) {
            abort(404);
        }
        $activity->delete();
        return redirect()->action('ActivityController@index')
                         ->withSuccess(__('Activity has been deleted.'));
    }

    /**
     * Stop the activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function stop(Request $request, Activity $activity)
    {
        if ($activity->user != $request->user()) {
            abort(404);
        }
        $activity->stop();
        return back()->withSuccess(__('Activity has been stopped.'));
    }
}
