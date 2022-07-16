<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'content' => 'I\'d recommend using PDO (PHP Data Objects) to run parameterized SQL queries.\n\nNot only does this protect against SQL injection, but it also speeds up queries.\n\nAnd by using PDO rather than mysql_, mysqli_, and pgsql_ functions, you make your application a little more abstracted from the database, in the rare occurrence that you have to switch database providers.',
                'question_id' => 1,
                'user_id' => 1,
                'is_best' => 1
            ],
            [
                'content' => 'You could do something basic like this:\n\n$safe_variable = mysqli_real_escape_string($_POST["user-input"], $dbConnection);\nmysqli_query($dbConnection, "INSERT INTO table (column) VALUES (\'" . $safe_variable . "\')");\n\nThis won\'t solve every problem, but it\'s a very good stepping stone. I left out obvious items such as checking the variable\'s existence, format (numbers, letters, etc.).',
                'question_id' => 1,
                'user_id' => 2,
                'is_best' => 0
            ],
            [
                'content' => 'Whatever you do end up using, make sure that you check your input hasn\'t already been mangled by magic_quotes or some other well-meaning rubbish, and if necessary, run it through stripslashes or whatever to sanitize it.',
                'question_id' => 1,
                'user_id' => 3,
                'is_best' => 0
            ],
        ]);
    }
}
