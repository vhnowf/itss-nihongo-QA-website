<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Answer;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $formData['content'] = $request->content;
        $formData['question_id'] = $request->question_id;
        $formData['user_id']  = auth()->user()->id;       

        $answer = Answer::create($formData);

        return response()->json([
            'status' => 200,
            'message' => __('Post answer successfully!'),
            'question' => $answer,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->delete();

        return response()->json([
            'status' => 200,
            'message' => __('Delte successfully'),
        ]);
    }

    public function checkBest(Request $request, $id) 
    {
        $answers = Answer::where('question_id', $request->question_id)->get();
        foreach ($answers as $answer) {
            if ($answer->id == $id) {
                $answer->is_best = $answer->is_best == 1 ? 0 : 1;
            } else {
                $answer->is_best = 0;
            }
            $answer->save();
        }

        return response()->json('Update check best successful');
    }
}
