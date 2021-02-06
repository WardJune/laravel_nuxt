<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $year = $request->year;
        if (empty($year)) {
            $year = date('Y');
        }
        $month = $request->month;
        if (empty($month)) {
            $month = date('m');
        }
        $models = Presence::where('employee_id', $user->id)->whereRaw("year(date) = ?", [$year])->whereRaw("month(date) = ?", [$month])->get();
        $data = $models->groupBy('date')->map(function ($rows, $date) {
            return [
                'checkin_time' => $rows->min('time'),
                'checkout_time' => $rows->max('time'),
                'date' => $date
            ];
        })->values();
        $count = $data->count();
        return response()->json([
            'data' => $data,
            'count' => $count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Presence::create([
            'employee_id' => Auth::user()->id,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'timezone' => $request->timezone,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'metadata' => [],
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
