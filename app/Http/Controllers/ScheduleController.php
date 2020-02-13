<?php

namespace App\Http\Controllers;

use App\schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return schedule::all();
        $schedules = \DB::table('schedules')
                    ->where('isConfirmed',1)
                    ->get();
        return response()->json($schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return schedule::create([
            'schedule_type' => $request['type'],
            'start_date' => $request['date'].' '.$request['from'],
            'end_date' => $request['date'].' '.$request['to'],
            'id_number' => $request['id_number'],
            'user_id' => \Auth::user()->id,
            'isConfirmed' => 0
           ]);
        dd($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(schedule $schedule)
    {
        //
    }


    public function getAllSchedules(){

        $schedule = \DB::table('schedules')
                    ->select('users.*','schedules.id as scid','schedules.user_id',
                    'schedules.start_date','schedules.end_date','schedules.schedule_type',
                    'schedules.isConfirmed',
                    \DB::raw("SUBSTRING_INDEX(schedules.start_date, ' ', 1) AS date"),
                    \DB::raw("SUBSTRING(schedules.start_date, LOCATE(' ', schedules.start_date)) AS start_time"),
                    \DB::raw("SUBSTRING(schedules.end_date, LOCATE(' ', schedules.end_date)) AS end_time"),
                    \DB::raw("CONCAT(schedules.start_date,' ',schedules.end_date) as combined_date"))
                    ->join('users','users.id','=','schedules.user_id')
                    ->get();

                  
        return response()->json($schedule);
    }


    public function updateSchedule(Request $request,$id){
        $schedule_id = schedule::findOrFail($id);

        $schedule_id->isConfirmed = $request->isConfirmed;
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.welcome', [], function($message) use($request) 
            {
                $message
                    ->from('UMTC@umindanao.edu.ph')
                    ->to($request->email)
                    ->subject('UMTC Scheduler');
            });
        $schedule_id->save($request->all());

     
    
    }
}
