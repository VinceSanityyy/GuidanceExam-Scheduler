<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAllScores(){
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
                ->groupBy('answers.user_id')
                ->get();

        return response()->json($all);
    }
}
