<?php

namespace App\Http\Controllers;

use App\schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
                    ->where('schedules.schedule_type','Consultation')
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

        // dd($request['selected']['id']);

        $user_id = $request['selected']['id'];

        $creds = \DB::table('users')
                    ->where('id',$user_id)
                    ->select('email','mobile')
                    ->get();
        $res = json_decode($creds,true);
        $email_address = $res[0]['email'];
        $mobile_number = $res[0]['mobile'];

        // dd($creds);

        // dd($mobile_number);
        
        // dd($request->date);
     
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.email', [
            'date' => $request->date,
            'from' => date("g:i a", strtotime($request->from)),
            'to' =>  date("g:i a", strtotime($request->to)),
        ], function($message) use($email_address,$request) 
            {
                $message
                    ->from('UMTC@umindanao.edu.ph','UMTC Scheduler')
                    ->to($email_address)
                    ->subject('UMTC Scheduler');
            });

        $basic  = new \Nexmo\Client\Credentials\Basic('e0de6744', 'wVLksPGxoZp75TSl');
        $client = new \Nexmo\Client($basic);
            
        $message = $client->message()->send([
                'to' => $mobile_number,
                'from' => 'UMTC Scheduler',
                'text' => 'Good Day! This is to inform that your schedule for  .'$request->type'.  is on '.$request->date.' from 
                '.date("g:i a", strtotime($request->from)).' to '.date("g:i a", strtotime($request->to)).'. Kindly go to the guidance office for more information.'
            ]);   
        

        $this->validate($request, [
            'type' => 'required',
            'selected' => 'required',
            'typeOfSched' => 'required',
           ]);

        if($request['type'] == "Examination - Beck's Depression Inventory"
        ){
            return schedule::create([
                'schedule_type' => $request['type'],
                'start_date' => $request['date'],
                'end_date' => $request['date'],
                // 'id_number' => $request['id_number'],
                'user_id' => $request['selected']['id'],
                'type' => $request['typeOfSched'],
                'isConfirmed' => 1
               ]);
        }
        elseif($request['type'] == 'Examination - College Adjustment Scale'
        ||$request['type'] == 'Examination - Standard Progressive Matrices'
        ||$request['type'] == 'Examination - 16 Personality Factor Test'
        ||$request['type'] == 'Examination - Filipino Work Values Scale'
        ||$request['type'] == 'Examination - IQ Test'
        ||$request['type'] == 'Examination - Basic Personality Inventory'
        ||$request['type'] == 'Examination - BarOn Emotional Quotient Inventory'){

          
            

             return schedule::create([
                'schedule_type' => $request['type'],
                'start_date' => $request['date'],
                'end_date' => $request['date'],
                // 'id_number' => $request['id_number'],
                'user_id' => $request['selected']['id'],
                'type' => $request['typeOfSched'],
                'isConfirmed' => 1 
             ], \DB::table('answers')->insert([
                'question_id' => 1,
                'choice_id' => 1,
                'user_id' => $user_id
            ]));

        

        }
        elseif($request['type'] == 'Consultation'){

            return schedule::create([
                'schedule_type' => $request['type'],
                'start_date' => $request['date'].' '.rtrim($request['from']),
                'end_date' => $request['date'].' '.rtrim($request['to']),
                // 'id_number' => $request['id_number'],
                'user_id' => $request['selected']['id'],
                'type' => $request['typeOfSched'],
                'isConfirmed' => 1
               ]);
        }

       
      
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
                    'schedules.isConfirmed','schedules.type',
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
                    ->from('UMTC@umindanao.edu.ph','UMTC Scheduler')
                    ->to($request->email)
                    ->subject('UMTC Scheduler');
            });


        $basic  = new \Nexmo\Client\Credentials\Basic('e0de6744', 'wVLksPGxoZp75TSl');
            $client = new \Nexmo\Client($basic);
            
        $message = $client->message()->send([
                'to' => $request->mobile,
                'from' => 'UMTC Scheduler',
                'text' => 'Your request has been approved by the guidance office.'
            ]);

        
        \DB::table('notifications')->insert([
            'schedule_id' => $schedule_id->id,
            'message' => 'Request from Guidance Office has been approved!'
        ]);

        $schedule_id->save($request->all());
    }

    public function setScheduleResults(Request $request, $id){
        $schedule_id = schedule::findOrFail($id);

       
        $schedule_id->isConfirmed = $request->status;

        $user_id = $schedule_id->user_id;


       

           /**
         * Classification
         * 0-13 = Mild
         * 14-19 = Minimal
         * 20-28 = Moderate
         * 29-63  = Severe
         */

         if($request->result == 'Mild'){
            \DB::table('answers')->insert([
                'question_id' => 2,
                'choice_id' => 3,
                'user_id' => $user_id
            ]);
         }
         elseif($request->result == 'Minimal'){
            \DB::table('answers')->insert([
                ['question_id' => 2,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 3,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 4,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 5,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 6,'choice_id' => 4,'user_id' => $user_id],
            ]);
         }
         elseif($request->result == 'Moderate'){
            \DB::table('answers')->insert([
                ['question_id' => 2,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 3,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 4,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 5,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 6,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 7,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 8,'choice_id' => 4,'user_id' => $user_id],
            ]);
         }
         elseif($request->result == 'severe'){
            \DB::table('answers')->insert([
                ['question_id' => 2,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 3,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 4,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 5,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 6,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 7,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 8,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 9,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 10,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 11,'choice_id' => 4,'user_id' => $user_id],
                ['question_id' => 12,'choice_id' => 4,'user_id' => $user_id],
                
            ]);
         }
         
         

         $schedule_id->save($request->all());
    }

    public function reSchedule(Request $request,$id){
        $schedule_id = schedule::findOrFail($id);
        // $schedule_id = $request->scid;

        $schedule_id->start_date = $request->date.' '.rtrim($request->from);
        $schedule_id->end_date = $request->date.' '.rtrim($request->to);
        $schedule_id->isConfirmed = 1;
       
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.resched', [
            'date' => $request->date,
            'from' => date("g:i a", strtotime($request->from)),
            'to' =>  date("g:i a", strtotime($request->to)),
        ], function($message) use($request) 
            {
                $message
                    ->from('UMTC@umindanao.edu.ph','UMTC Scheduler')
                    ->to($request->email)
                    ->subject('UMTC Scheduler');
            });


        $basic  = new \Nexmo\Client\Credentials\Basic('e0de6744', 'wVLksPGxoZp75TSl');
            $client = new \Nexmo\Client($basic);
            
        $message = $client->message()->send([
                'to' => $request->mobile,
                'from' => 'UMTC Scheduler',
                'text' => 'Your request from the guidance office has been rescheduled to '
                 .$request->date.' from '.date("g:i a", strtotime($request->from)). ' to ' .date("g:i a", strtotime($request->to)). ''
            ]);

        \DB::table('notifications')->insert([
                'schedule_id' => $schedule_id->id,
                'message' => 'Your request from the guidance office has been rescheduled to '.$request->date
            ]);    

        
        $schedule_id->save($request->all());
    }


    public function getSchedulesByYearLevel(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $formatted_date_from = Carbon::parse($date_from)->startOfMonth();
        $formatted_date_to = Carbon::parse($date_to)->endOfMonth();
        $schedules = \DB::table('schedules')
                    ->join('users','users.id','=','schedules.user_id')
                    ->select('users.yearlevel as label',\DB::raw("COUNT('schedules.*') as value"))
                    ->groupBy('users.yearlevel')
                    // ->whereYear('schedules.created_at', $formatted_year)
                    // ->whereMonth('schedules.created_at', $formatted_month)
                    ->whereBetween('schedules.created_at', [$formatted_date_from,$formatted_date_to])
                    ->get();
        // dd($formatted_year);
        return response()->json($schedules);        
    }

    public function getSchedulesByCourse(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $formatted_date_from = Carbon::parse($date_from)->startOfMonth();
        $formatted_date_to = Carbon::parse($date_to)->endOfMonth();

        $schedules = \DB::table('schedules')
        ->join('users','users.id','=','schedules.user_id')
        ->select('users.course as label',\DB::raw("COUNT('schedules.*') as value"))
        ->groupBy('users.course')
        // ->whereYear('schedules.created_at', $formatted_year)
        // ->whereMonth('schedules.created_at', $formatted_month)
        ->whereBetween('schedules.created_at', [$formatted_date_from,$formatted_date_to])
        ->get();

        // dd($formatted_year);
        return response()->json($schedules);
    }

    public function getSchedulesByType(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $formatted_date_from = Carbon::parse($date_from)->startOfMonth();
        $formatted_date_to = Carbon::parse($date_to)->endOfMonth();

        $schedules = \DB::table('schedules')
        ->select('schedules.type as label',\DB::raw("COUNT('schedules.*') as value"))
        ->groupBy('schedules.type')
        // ->whereYear('schedules.created_at', $formatted_year)
        // ->whereMonth('schedules.created_at', $formatted_month)
        ->whereBetween('schedules.created_at', [$formatted_date_from,$formatted_date_to])
        ->get();

        // dd($formatted_year);
        return response()->json($schedules);
    }

    public function getSchedulesByGender(Request $request){
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $formatted_date_from = Carbon::parse($date_from)->startOfMonth();
        $formatted_date_to = Carbon::parse($date_to)->endOfMonth();
        // dd($formatted_date_from)->startOfMonth();;
        $schedules = \DB::table('schedules')
        ->join('users','users.id','=','schedules.user_id')
        ->select('users.sex as label',\DB::raw("COUNT('schedules.*') as value"))
        ->groupBy('users.sex')
        // ->whereYear('schedules.created_at', $formatted_year)
        // ->whereMonth('schedules.created_at', $formatted_month)
        ->whereBetween('schedules.created_at', [$formatted_date_from,$formatted_date_to])
        ->get();

        // $date_from = $request->date_from;
        // $date_to = $request->date_to;
        // $formatted_date_from = Carbon::parse($date_from)->startOfMonth();->format('yy-m');
        // $formatted_date_to = Carbon::parse($date_to)->endOfMonth();->format('yy-m');
        // ->whereBetween('schedules.created_at', [$formatted_date_from,$formatted_date_to])

        // dd($formatted_year);
        return response()->json($schedules);
    }

    public function getAllScore(){
        $all = \DB::table('answers')
                    ->join('choices', function ($q) {
                    $q->on('answers.choice_id','=','choices.choice_id')
                    ->on('answers.question_id', '=', 'choices.question_id');
                    })
                    ->select('schedules.id as resId','schedules.schedule_type','schedules.isConfirmed','schedules.start_date','schedules.end_date','answers.user_id', 'users.name','users.course','users.age','users.email',
                    \DB::raw('SUM(choices.value)as score'))
                    // ->rightJoin('users as u','users.id','=','schedules.user_id')
                    ->join('users','users.id','answers.user_id')
                    ->join('schedules','schedules.user_id','answers.user_id')
                    ->where('schedules.schedule_type','LIKE','%Examination%')
                    ->orWhere('schedules.isConfirmed',2)
                    ->orWhere('schedules.isConfirmed',1)
                    // ->orWhere('schedules.isConfirmed',4)
                    ->groupBy('answers.user_id')
                    ->get();
        return response()->json($all);
        /**
         * Classification
         * 0-13 = Mild
         * 14-19 = Minimal
         * 20-28 = Moderate
         * 29-63  = Severe
         */
    }
}
