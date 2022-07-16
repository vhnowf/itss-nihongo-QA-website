<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [    //1
                'title' => 'How can I prevent SQL injection in PHP?',
                'content' => 'If user input is inserted without modification into an SQL query, then the application becomes vulnerable to SQL injection, like in the following example:\n\n$unsafe_variable = $_POST[\'user_input\'];\nmysql_query("INSERT INTO `table` (`column`) VALUES (\'$unsafe_variable\')");\n\nThat\'s because the user can input something like value\'); DROP TABLE table;--, and the query becomes:\n\nINSERT INTO `table` (`column`) VALUES(\'value\'); DROP TABLE table;--\')\n\nWhat can be done to prevent this from happening?',
                'owner_id' => 4,
                'status' => 2,
            ],
            [    //2
                'title' => 'Difference between require, include, require_once and include_once?',
                'content' => 'In PHP:\n\nWhen should I use require vs. include?\n\nWhen should I use require_once vs. include_once?',
                'owner_id' => 5,
                'status' => 2,
            ], 
            [    //3
                'title' => 'irregular characters with the pattern 86/88 assembly language',
                'content' => 'Following pattern is to be print in the 86/88 assembly language but some irrelevant characters are also printing. ',
                'owner_id' => 6,
                'status' => 2,
            ], 
            [    //4
                'title' => 'How to convert android project in apk without android studio',
                'content' => 'How to convert android project to apk file without android studio using.',
                'owner_id' => 5,
                'status' => 2,
            ], 
            [    //5
                'title' => 'reading data from a file and store in structure array',
                'content' => 'I have written the following program and wanted to ask why the output doesn\'t output the order that follow in the text file? How can I debug this code? #include iostream',
                'owner_id' => 7,
                'status' => 2,
            ],   [    //6
                'title' => 'Convert the GraphQL PAYLOAD to GraphQL query in JS',
                'content' => 'I am trying to fetch all the leetcode questions. But leetcode does not provide any API. So I found that leetcode uses graphql query to get the lists of questions using the following payload',
                'owner_id' => 9,
                'status' => 2,
            ],   [    //7
                'title' => 'Unable to load SwiftUI view in MacPlugin(a shared protocol between Appkit + UIKit) for Mac Catalyst app',
                'content' => 'Long story short, my usecase is to include Status bar menu in Mac catalyst app, for that I need to access Appkit library. Thanks to shared protocol approach I can include both Appkit & UIkit',
                'owner_id' => 5,
                'status' => 2,
            ],   [    //8
                'title' => 'Unable to create 3 tier-architecture',
                'content' => 'I have this code. I have to transform it to 3-tier architecture. But I am getting multiple errors such as: TypeError: \'function\' object has no attribute and TypeError: \'function\' object',
                'owner_id' => 10,
                'status' => 2,
            ],   [    //9
                'title' => 'having problem virtualenv cannot create virtualenv',
                'content' => 'Microsoft Windows [Version 10.0.22509.1000] (c) Microsoft Corporation. All rights reserved. C:\WINDOWS\System32>cd C:\Users\adity\OneDrive\Desktop\GFG C:\Users\adity\OneDrive\Desktop\GFG>pip',
                'owner_id' => 10,
                'status' => 2,
            ],   [    //10
                'title' => 'Is there any way in which I can sort every pair of columns with the same name in a df on Python? Pandas related',
                'content' => 'Let\'s say I have the following df: 0 1 2 3 4 5 0 1 2 3 4 5 0 Fondo Cuerpo Ojos Color Pinzas Puas Oceano Cuerpo',
                'owner_id' => 8,
                'status' => 2,
            ],   [    //11
                'title' => 'Template contains errors.: Template error: instance of Fn::GetAtt references undefined resource LambdaInvokeFunction in api gateway',
                'content' => 'Am getting the same error. this is my entire code. can anyone solve it plz. AWSTemplateFormatVersion: 2010-09-09 Description: My API Gateway and Lambda function Parameters: ResourcesPrefix: Type: ...',
                'owner_id' => 11,
                'status' => 2,
            ],   [    //12
                'title' => 'Weird behavior of setTimeout function',
                'content' => 'When I was just playing around with setTimeout() function, I noticed this. I don\'t understand why the setTimeout() is working this way. The code on which I was working: setTimeout(() =>console',
                'owner_id' => 12,
                'status' => 2,
            ],   [    //13
                'title' => 'how to count when the value is null or < 0 mysql',
                'content' => 'i\'ve problem with sql. here\'s my sql code : SELECT COUNT(id) as jml_bulan case when jml_bulan > 0 then jml_bulan else 0 end FROM table_so_sales',
                'owner_id' => 13,
                'status' => 2,
            ],   [    //14
                'title' => 'Negative Index in sympy function cannot be displayed after sympify',
                'content' => 'I have a project where I need to display negative indices in my formula that I generate with inputs that are unknown before runtime so I have to call sympy.sympify() on these equations. However, this',
                'owner_id' => 16,
                'status' => 2,
            ],   [    //15
                'title' => 'Performing a long task in a handler',
                'content' => 'I\'m trying to use aiojobs while using aiohttp to handle a long operation on a post endpoint. The process can take about 200 seconds on my local machine and when deployed to heroku the request will ...',
                'owner_id' => 14,
                'status' => 2,
            ],   [    //16
                'title' => 'Pattern synonyms as overloadable \'smart constructors\'',
                'content' => 'There\'s a fine tradition of including \'smart constructor\' methods in an interface (class): class Collection c a where empty :: c a singleton :: a -> c a -- etc It would be nice to supply',
                'owner_id' => 15,
                'status' => 2,
            ],   [    //17
                'title' => 'I built a Quiz app I have a problem that sometimes the method of correct answer and incorrect answer are run together. The problem occurs occasionally',
                'content' => 'I built a Quiz app I have a problem that sometimes the method of correct answer and incorrect answer are run together. The problem occurs occasionally. I will note that the code works fine.',
                'owner_id' => 16,
                'status' => 2,
            ],   [    //18
                'title' => 'zsh custom function breaks',
                'content' => 'I\'m new to zsh and struggling with this simplest function which worked perfectly for me in bash. I\'m adding it to .zshrc file. function gcp { git add . git commit -am "$@" git',
                'owner_id' => 32,
                'status' => 2,
            ],   [    //19
                'title' => 'Error passing td.parentNode javascript on \'onclick\' method',
                'content' => 'Im working with DataTables(https://datatables.net/examples/basic_init/zero_configuration.html) and javascript, right now Im dealing with \'edit\' behavior, If I click on edit icon a whole row should be ',
                'owner_id' => 33,
                'status' => 2,
            ],   [    //20
                'title' => 'How to return child object names along with parent details in django',
                'content' => 'I have two models Destination and Cruise #Models class Destination(models.Model): name = models.CharField(unique= True, null= False, blank=False, max_length= 50) description = models.TextField',
                'owner_id' => 5,
                'status' => 2,
            ],           
        ]);
    }
}
