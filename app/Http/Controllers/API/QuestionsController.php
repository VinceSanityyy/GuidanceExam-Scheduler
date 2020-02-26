<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answers;
use App\schedule;
class QuestionsController extends Controller
{
    public function viewQuestionsWithChoices(Request $request){
            $questions = \DB::table('questions')
                        ->where('questions.isActive',1)
                        ->select('questions.question','question_id')
                        ->where('questions.question_id',$request->question_id)
                        ->get();


            $choices = \DB::table('choices')
                        ->where('question_id',$request->question_id)
                        ->select('choice as label','value')
                        ->get();

        // $merged = $questions->merge($questions); 
        $questions = json_encode($questions);
        $questions = json_decode($questions,true);
        $question_id  = $questions[0]['question_id'];
        $question  = $questions[0]['question'];
        // dd($question);
        // $question_id = $questions['question_id'];
        // $question = $questions['question'];
        // dd($questions);
        // dd($questions['question']);
        return response()->json([
        'question_id'=>$question_id,
        'question'=>$question,
        'choices'=>$choices
        ]);
    }

    public function submitAnswer(Request $request){
        $questions = \DB::table('questions')
        ->where('questions.isActive',1)
            ->select('questions.question','question_id')
            ->where('question_id',$request->question_id)
            ->get();


        $choices = \DB::table('choices')
            ->where('question_id',$request->question_id)
            ->select('choice','value')
            ->get();

        $this->validate($request,[
            'choice_id' => 'required'
        ]);

        $update = \DB::table('schedules')
                ->where('user_id',\Auth::user()->id)
                ->where('schedule_type','Examination')
                ->update(['isConfirmed' => 2]);

        return Answers::create([
            'choice_id' => $request['choice_id'],
            'user_id' => \Auth::user()->id,
            'question_id' => $request['question_id']
        ]);


        
    }

    public function getSchedules(){
        $schedules = \DB::table('schedules')
                    ->where('user_id',\Auth::user()->id)
                    ->get();
        
        return response()->json($schedules);
    }

    public function personalScore(){
        $all = \DB::table('answers')
                    ->join('choices', function ($q) {
                    $q->on('answers.choice_id','=','choices.choice_id')
                    ->on('answers.question_id', '=', 'choices.question_id');
                    })
                    ->select('schedules.schedule_type','schedules.start_date','schedules.end_date','answers.user_id', 'users.name','users.course','users.age','users.email',
                    \DB::raw('sum(choices.value) as score'))
                    ->join('users','users.id','answers.user_id')
                    ->join('schedules','schedules.user_id','answers.user_id')
                    ->where('schedules.schedule_type','Examination')
                    ->where('answers.user_id',\Auth::user()->id)
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

    // public function personalScoreWithDetails(){
    //     $all = \DB::table('answers')
    //                 ->join('choices', function ($q) {
    //                 $q->on('answers.choice_id','=','choices.choice_id')
    //                 ->on('answers.question_id', '=', 'choices.question_id');
    //                 })
    //                 ->select('schedules.schedule_type','answers.user_id', 'users.name','users.course','users.age','users.email',
    //                 \DB::raw('sum(choices.value) as score'))
    //                 ->join('users','users.id','answers.user_id')
    //                 ->join('schedules','schedules.user_id','answers.user_id')
    //                 ->where('answers.user_id',\Auth::user()->id)
    //                 ->get();
    //     return response()->json($all);
    // }


    public function createSchedule (Request $request){
        if($request['type'] == 'Examination - College Adjustment Scale'
        ||$request['type'] == 'Examination - Standard Progressive Matrices'
        ||$request['type'] == 'Examination - 16 Personality Factor Test'
        ||$request['type'] == "Examination - Beck's Depression Inventory"
        ||$request['type'] == 'Examination - Filipino Work Values Scale'
        ||$request['type'] == 'Examination - IQ Test'
        ||$request['type'] == 'Examination - Basic Personality Inventory'
        ||$request['type'] == 'Examination - BarOn Emotional Quotient Inventory'
        ){
            return schedule::create([
                'schedule_type' => $request['type'],
                'start_date' => $request['date'],
                'end_date' => $request['date'],
                // 'id_number' => $request['id_number'],
                'user_id' => \Auth::user()->id,
                'isConfirmed' => 0
               ]);
        }

        return schedule::create([
            'schedule_type' => $request['type'],
            'start_date' => $request['date'].' '.$request['from'],
            'end_date' => $request['date'].' '.$request['to'],
            // 'id_number' => $request['id_number'],
            'user_id' => \Auth::user()->id,
            'isConfirmed' => 0
           ]);
    }
}
