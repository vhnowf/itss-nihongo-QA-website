<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class QuestiontagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_tag')->insert([
            [
                'question_id' => 1,
                'tag_id' => 1
            ],
            [
                'question_id' => 1,
                'tag_id' => 2
            ],
            [
                'question_id' => 1,
                'tag_id' => 3
            ],
            [
                'question_id' => 1,
                'tag_id' => 4
            ]
            ,
            [
                'question_id' => 2,
                'tag_id' => 2
            ],
            [
                'question_id' => 2,
                'tag_id' => 3
            ],
            [
                'question_id' => 2,
                'tag_id' => 5
            ],
            [
                'question_id' => 3,
                'tag_id' => 4
            ],
            [
                'question_id' => 3,
                'tag_id' => 4
            ],
            [
                'question_id' => 3,
                'tag_id' => 5
            ],
            [
                'question_id' => 3,
                'tag_id' => 7
            ],
            [
                'question_id' => 3,
                'tag_id' => 9
            ],
            [
                'question_id' => 4,
                'tag_id' => 10
            ],
            [
                'question_id' => 4,
                'tag_id' => 2
            ],
            [
                'question_id' => 4,
                'tag_id' => 5
            ],
            [
                'question_id' => 5,
                'tag_id' => 4
            ],
            [
                'question_id' => 5,
                'tag_id' => 18
            ],
            [
                'question_id' => 5,
                'tag_id' => 20
            ],
            [
                'question_id' => 6,
                'tag_id' => 10
            ],
            [
                'question_id' => 7,
                'tag_id' => 4
            ],
            [
                'question_id' => 7,
                'tag_id' => 9
            ],
            [
                'question_id' => 7,
                'tag_id' => 8
            ],
            [
                'question_id' => 8,
                'tag_id' => 5
            ],
            [
                'question_id' => 9,
                'tag_id' => 4
            ],
            [
                'question_id' => 9,
                'tag_id' => 8
            ],
            [
                'question_id' => 9,
                'tag_id' => 20
            ],
            [
                'question_id' => 10,
                'tag_id' => 21
            ],
            [
                'question_id' => 11,
                'tag_id' => 21
            ],
            [
                'question_id' => 12,
                'tag_id' => 15
            ],
            [
                'question_id' => 13,
                'tag_id' => 14
            ],
            [
                'question_id' => 13,
                'tag_id' => 12
            ],
            [
                'question_id' => 14,
                'tag_id' => 21
            ],
            [
                'question_id' => 14,
                'tag_id' => 24
            ],
            [
                'question_id' => 15,
                'tag_id' => 34
            ],
            [
                'question_id' => 15,
                'tag_id' => 35
            ],
            [
                'question_id' => 16,
                'tag_id' => 26
            ],
            [
                'question_id' => 16,
                'tag_id' => 24
            ],
            [
                'question_id' => 17,
                'tag_id' => 25
            ],
            [
                'question_id' => 17,
                'tag_id' => 30
            ],
            [
                'question_id' => 18,
                'tag_id' => 44
            ],
            [
                'question_id' => 18,
                'tag_id' => 50
            ],
            [
                'question_id' => 19,
                'tag_id' => 4
            ],
            [
                'question_id' => 19,
                'tag_id' => 5
            ],
            [
                'question_id' => 20,
                'tag_id' => 31
            ],
            [
                'question_id' => 20,
                'tag_id' => 17
            ]
        ]);
    }
}
