<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'question_id' => 1,
                'question' => 'Question No 1',
                'isActive' => 1
            ],
            [
                'question_id' => 2,
                'question' => 'Question No 2',
                'isActive' => 1
            ],
            [
                'question_id' => 3,
                'question' => 'Question No 3',
                'isActive' => 1
            ],
            [
                'question_id' => 4,
                'question' => 'Question No 4',
                'isActive' => 1
            ],
            [
                'question_id' => 5,
                'question' => 'Question No 5',
                'isActive' => 1
            ],
            [
                'question_id' => 6,
                'question' => 'Question No 6',
                'isActive' => 1
            ],
            [
                'question_id' => 7,
                'question' => 'Question No 7',
                'isActive' => 1
            ],
            [
                'question_id' => 8,
                'question' => 'Question No 8',
                'isActive' => 1
            ],
            [
                'question_id' => 9,
                'question' => 'Question No 9',
                'isActive' => 1
            ],
            [
                'question_id' => 10,
                'question' => 'Question No 10',
                'isActive' => 1
            ],
            [
                'question_id' => 11,
                'question' => 'Question No 11',
                'isActive' => 1
            ],
            [
                'question_id' => 12,
                'question' => 'Question No 12',
                'isActive' => 1
            ],
            [
                'question_id' => 13,
                'question' => 'Question No 13',
                'isActive' => 1
            ],
            [
                'question_id' => 14,
                'question' => 'Question No 14',
                'isActive' => 1
            ],
            [
                'question_id' => 15,
                'question' => 'Question No 15',
                'isActive' => 1
            ],
            [
                'question_id' => 16,
                'question' => 'Question No 16',
                'isActive' => 1
            ],
            [
                'question_id' => 17,
                'question' => 'Question No 17',
                'isActive' => 1
            ],
            [
                'question_id' => 18,
                'question' => 'Question No 18',
                'isActive' => 1
            ],
            [
                'question_id' => 19,
                'question' => 'Question No 19',
                'isActive' => 1
            ],
            [
                'question_id' => 20,
                'question' => 'Question No 20',
                'isActive' => 1
            ],
            [
                'question_id' => 21,
                'question' => 'Question No 21',
                'isActive' => 1
            ],
        ];
        \DB::table('questions')->insert($questions);
    }
}
