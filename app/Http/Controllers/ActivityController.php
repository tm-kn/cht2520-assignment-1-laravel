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
     * @return \Illuminate\Http\Response
     */
    public function index(FilterActivity $request)
    {
        $validated = $request->validated();
        $startDate = Carbon::today()->subDays(7);
        if(array_key_exists('start_date', $validated)) {
            $startDate = new Carbon($validated['start_date']);
        }

        $endDate = Carbon::today();
        if(array_key_exists('end_date', $validated)) {
            $endDate = new Carbon($validated['end_date']);
        }

        $searchQuery = [];
        if(array_key_exists('search_query', $validated)) {
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
            ->where('end_datetime', '<=', $endDate->endOfDay());

        if($searchQuery) {
            $activities->where(function($query) use ($searchQuery) {
                foreach($searchQuery as $searchTerm) {
                    $query->orWhere('activity', 'ILIKE', '%' . $searchTerm . '%');
                    $query->orWhere('project', 'ILIKE', '%' . $searchTerm . '%');
                    $query->orWhere('description', 'ILIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return view('activity.index')
            ->withActivities($activities->get())
            ->withFormData([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'search_query' => $searchQuery,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivity $request)
    {
        $validated = $request->validated();
        $activity = new Activity($validated);
        $activity->user_id = $request->user()->id;
        $activity->save();
        return redirect()->action('ActivityController@index')
                         ->withSuccess('Activity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activity.show')->withActivity($activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->action('ActivityController@index')
                         ->withSuccess('Activity has been deleted.');
    }
}
