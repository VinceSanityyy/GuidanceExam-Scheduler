<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answers;
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
                        ->select('choice','value')
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

        return Answers::create([
            'choice_id' => $request['choice_id'],
            'user_id' => \Auth::user()->id,
            'question_id' => $request['question_id']
        ]);


        
    }
}
