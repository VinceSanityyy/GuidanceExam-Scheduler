<?php

use Illuminate\Database\Seeder;

class ChoicesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $choices = [
            
            //Question 1
            [
                'choice_id' => 1,
                'question_id' =>1,
                'value' => 0,
                'choice' => 'I do not feel sad'
            ],
            [
                'choice_id' => 2,
                'question_id' =>1,
                'value' => 1,
                'choice' => 'I feel sad'
            ],
            [
                'choice_id' => 3,
                'question_id' =>1,
                'value' => 2,
                'choice' => "I am sad all the time and I can't snap out of it "
            ],
            [
                'choice_id' => 4,
                'question_id' =>1,
                'value' => 3,
                'choice' => "I am so sad and unhappy that I can't stand it"
            ],
            
            //Question 2
            [
                'choice_id' => 1,
                'question_id' =>2,
                'value' => 0,
                'choice' => 'I am not particularly discouraged about the future'
            ],
            [
                'choice_id' => 2,
                'question_id' =>2,
                'value' => 1,
                'choice' => 'I feel discourated about the future'
            ],
            [
                'choice_id' => 3,
                'question_id' =>2,
                'value' => 2,
                'choice' => "I feel I have nothing to look forward to"
            ],
            [
                'choice_id' => 4,
                'question_id' =>2,
                'value' => 3,
                'choice' => "I feel the future is hopeless and that things cannot improve"
            ],
            
            //Question 3
            [
                'choice_id' => 1,
                'question_id' =>3,
                'value' => 0,
                'choice' => 'I am not particularly discouraged about the future'
            ],
            [
                'choice_id' => 2,
                'question_id' =>3,
                'value' => 1,
                'choice' => 'I feel discourated about the future'
            ],
            [
                'choice_id' => 3,
                'question_id' =>3,
                'value' => 2,
                'choice' => "I feel I have nothing to look forward to"
            ],
            [
                'choice_id' => 4,
                'question_id' =>3,
                'value' => 3,
                'choice' => "I feel the future is hopeless and that things cannot improve"
            ],
            
            //Question 4
            [
                'choice_id' => 1,
                'question_id' =>4,
                'value' => 0,
                'choice' => 'I get as much satisfaction out of things as I used to'
            ],
            [
                'choice_id' => 2,
                'question_id' =>4,
                'value' => 1,
                'choice' => "I don't enjoy things the way I used to"
            ],
            [
                'choice_id' => 3,
                'question_id' =>4,
                'value' => 2,
                'choice' => "I don't get real satisfaction out of anything anymore"
            ],
            [
                'choice_id' => 4,
                'question_id' =>4,
                'value' => 3,
                'choice' => "I am dissatisfied or bored with everything"
            ], 
            
            //Question 5
            [
                'choice_id' => 1,
                'question_id' =>5,
                'value' => 0,
                'choice' => "I don't feel particularly guilty"
            ],
            [
                'choice_id' => 2,
                'question_id' =>5,
                'value' => 1,
                'choice' => "I feel guilty a good part of time"
            ],
            [
                'choice_id' => 3,
                'question_id' =>5,
                'value' => 2,
                'choice' => "I feel quite guilty most of the time"
            ],
            [
                'choice_id' => 4,
                'question_id' =>5,
                'value' => 3,
                'choice' => "I feel guilty all of the time"
            ],
            
            
            //Question 6
            [
                'choice_id' => 1,
                'question_id' =>6,
                'value' => 0,
                'choice' => "I don't feel I am being punished"
            ],
            [
                'choice_id' => 2,
                'question_id' =>6,
                'value' => 1,
                'choice' => "I feel I may be punished"
            ],
            [
                'choice_id' => 3,
                'question_id' =>6,
                'value' => 2,
                'choice' => "I expect to be punished"
            ],
            [
                'choice_id' => 4,
                'question_id' =>6,
                'value' => 3,
                'choice' => "I feel like I am being punished"
            ],
            
            //Question 7
            [
                'choice_id' => 1,
                'question_id' =>7,
                'value' => 0,
                'choice' => "I don't feel disappointed in myself"
            ],
            [
                'choice_id' => 2,
                'question_id' =>7,
                'value' => 1,
                'choice' => "I am disappointed with myself"
            ],
            [
                'choice_id' => 3,
                'question_id' =>7,
                'value' => 2,
                'choice' => "I am disgusted with myself"
            ],
            [
                'choice_id' => 4,
                'question_id' =>7,
                'value' => 3,
                'choice' => "I hate myself"
            ], 


              //Question 8
            [
                'choice_id' => 1,
                'question_id' =>8,
                'value' => 0,
                'choice' => "I don't feel I am any worse than anybody else"
            ],
            [
                'choice_id' => 2,
                'question_id' =>8,
                'value' => 1,
                'choice' => "I am critical of myself for my weaknesses or mistakes"
            ],
            [
                'choice_id' => 3,
                'question_id' =>8,
                'value' => 2,
                'choice' => "I blame myself all the time for my faults"
            ],
            [
                'choice_id' => 4,
                'question_id' =>8,
                'value' => 3,
                'choice' => "I blame myself for being everything bad that happens"
            ], 

                    //Question 9
            [
                'choice_id' => 1,
                'question_id' =>9,
                'value' => 0,
                'choice' => "I don't have any thoughts of killing myself"
            ],
            [
                'choice_id' => 2,
                'question_id' =>9,
                'value' => 1,
                'choice' => "I have thoughts of killing myself, but I would not carry them out"
            ],
            [
                'choice_id' => 3,
                'question_id' =>9,
                'value' => 2,
                'choice' => "I would like to kill myself"
            ],
            [
                'choice_id' => 4,
                'question_id' =>9,
                'value' => 3,
                'choice' => "I would kill myself if I had the chance"
            ],
            
                //Question 10
            [
                'choice_id' => 1,
                'question_id' =>10,
                'value' => 0,
                'choice' => "I don't cry any more than usual"
            ],
            [
                'choice_id' => 2,
                'question_id' =>10,
                'value' => 1,
                'choice' => "I cry more now than I used to"
            ],
            [
                'choice_id' => 3,
                'question_id' =>10,
                'value' => 2,
                'choice' => "I cry all the time now"
            ],
            [
                'choice_id' => 4,
                'question_id' =>10,
                'value' => 3,
                'choice' => "I used to be able to cry, but now I can;t cry even though I want to"
            ],
            
                //Question 11
            [
                'choice_id' => 1,
                'question_id' =>11,
                'value' => 0,
                'choice' => "I am no more irritated by things than I ever was"
            ],
            [
                'choice_id' => 2,
                'question_id' =>11,
                'value' => 1,
                'choice' => "I am slightly more irritated now than usual"
            ],
            [
                'choice_id' => 3,
                'question_id' =>11,
                'value' => 2,
                'choice' => "I am quite annoyed or irritated a good deal of the time"
            ],
            [
                'choice_id' => 4,
                'question_id' =>11,
                'value' => 3,
                'choice' => "I feel irritated all the time"
            ], 

                //Question 12
            [
                'choice_id' => 1,
                'question_id' =>12,
                'value' => 0,
                'choice' => "I have not lost interest in other people"
            ],
            [
                'choice_id' => 2,
                'question_id' =>12,
                'value' => 1,
                'choice' => "I am less interested in other people than I used to be"
            ],
            [
                'choice_id' => 3,
                'question_id' =>12,
                'value' => 2,
                'choice' => "I have lost most of my interest in other people"
            ],
            [
                'choice_id' => 4,
                'question_id' =>12,
                'value' => 3,
                'choice' => "I have lost all of my interest in other people"
            ], 

        
                     //Question 13
            [
                'choice_id' => 1,
                'question_id' =>13,
                'value' => 0,
                'choice' => "I make decisions about as well as I ever could"
            ],
            [
                'choice_id' => 2,
                'question_id' =>13,
                'value' => 1,
                'choice' => "I put off making decisions more than I used to"
            ],
            [
                'choice_id' => 3,
                'question_id' =>13,
                'value' => 2,
                'choice' => "I have greater difficulty in making decisions more than I used to"
            ],
            [
                'choice_id' => 4,
                'question_id' =>13,
                'value' => 3,
                'choice' => "I can't make decisions at all anymore"
            ], 


                //Question 14
            [
                'choice_id' => 1,
                'question_id' =>14,
                'value' => 0,
                'choice' => "I don't feel that I look any worse than I used to"
            ],
            [
                'choice_id' => 2,
                'question_id' =>14,
                'value' => 1,
                'choice' => "I am worried that I am looking old or unattractive"
            ],
            [
                'choice_id' => 3,
                'question_id' =>14,
                'value' => 2,
                'choice' => "I feel there are permanent changes in my appearance that makes me look unattractive"
            ],
            [
                'choice_id' => 4,
                'question_id' =>14,
                'value' => 3,
                'choice' => "I believe that I look ugly"
            ], 

            
                //Question 15
            [
                'choice_id' => 1,
                'question_id' =>15,
                'value' => 0,
                'choice' => "I can work about as well as before"
            ],
            [
                'choice_id' => 2,
                'question_id' =>15,
                'value' => 1,
                'choice' => "It takes an extra effort to get started at doing something"
            ],
            [
                'choice_id' => 3,
                'question_id' =>15,
                'value' => 2,
                'choice' => "I fhave to push myself very hard to do anything"
            ],
            [
                'choice_id' => 4,
                'question_id' =>15,
                'value' => 3,
                'choice' => "I can't do any work at all"
            ], 

                //Question 16
            [
                'choice_id' => 1,
                'question_id' =>16,
                'value' => 0,
                'choice' => "I can sleep as well as usual"
            ],
            [
                'choice_id' => 2,
                'question_id' =>16,
                'value' => 1,
                'choice' => "I don't sleep as well as I used to"
            ],
            [
                'choice_id' => 3,
                'question_id' =>16,
                'value' => 2,
                'choice' => "I wake up 1-2 hours earlier than usual and find it hard to get back to sleep"
            ],
            [
                'choice_id' => 4,
                'question_id' =>16,
                'value' => 3,
                'choice' => "I wake up several hours earlier than I used to and cannot get back to sleep"
            ], 

                       //Question 17
            [
                'choice_id' => 1,
                'question_id' =>17,
                'value' => 0,
                'choice' => "I don't get more tired than usual"
            ],
            [
                'choice_id' => 2,
                'question_id' =>17,
                'value' => 1,
                'choice' => "I get tired more easily than I used to"
            ],
            [
                'choice_id' => 3,
                'question_id' =>17,
                'value' => 2,
                'choice' => "I get tired from doing almost anything"
            ],
            [
                'choice_id' => 4,
                'question_id' =>17,
                'value' => 3,
                'choice' => "I am too tired to do anything"
            ], 


                //Question 18
            [
                'choice_id' => 1,
                'question_id' =>18,
                'value' => 0,
                'choice' => "My appetite is no worse than usual"
            ],
            [
                'choice_id' => 2,
                'question_id' =>18,
                'value' => 1,
                'choice' => "My appetite is not good as it used to be"
            ],
            [
                'choice_id' => 3,
                'question_id' =>18,
                'value' => 2,
                'choice' => "My appetite is much worse now"
            ],
            [
                'choice_id' => 4,
                'question_id' =>18,
                'value' => 3,
                'choice' => "I have no appetite at all anymore"
            ], 


                    //Question 19
            [
                'choice_id' => 1,
                'question_id' =>19,
                'value' => 0,
                'choice' => "I haven't lost so much weight if any, lately"
            ],
            [
                'choice_id' => 2,
                'question_id' =>19,
                'value' => 1,
                'choice' => "I have lost more than five pounds"
            ],
            [
                'choice_id' => 3,
                'question_id' =>19,
                'value' => 2,
                'choice' => "I have lost more than ten pounds"
            ],
            [
                'choice_id' => 4,
                'question_id' =>19,
                'value' => 3,
                'choice' => "I have lost more than fifteen pounds"
            ], 

                        //Question 20
            [
                'choice_id' => 1,
                'question_id' =>20,
                'value' => 0,
                'choice' => "I am no worried about my health than usual"
            ],
            [
                'choice_id' => 2,
                'question_id' =>20,
                'value' => 1,
                'choice' => "I am worried about physical problems like aches, pains, upset stomach, or consipation"
            ],
            [
                'choice_id' => 3,
                'question_id' =>20,
                'value' => 2,
                'choice' => "I am very worried about physical problems and it's hard to think of much else"
            ],
            [
                'choice_id' => 4,
                'question_id' =>20,
                'value' => 3,
                'choice' => "I am so worried about my physical problems that I cannto think of anything else"
            ],
            
            
                        //Question 21
            [
                'choice_id' => 1,
                'question_id' =>21,
                'value' => 0,
                'choice' => "I have noticed any recent change in my interest in sex"
            ],
            [
                'choice_id' => 2,
                'question_id' =>21,
                'value' => 1,
                'choice' => "I am less interested in sex than I used to be"
            ],
            [
                'choice_id' => 3,
                'question_id' =>21,
                'value' => 2,
                'choice' => "I have almost no interest in sex"
            ],
            [
                'choice_id' => 4,
                'question_id' =>21,
                'value' => 3,
                'choice' => "I have lost interest in sex completely"
            ], 
            
        ];

        \DB::table('choices')->insert($choices);
    }
}
