<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\Question;
use App\Validators\BaseValidatorInterface;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class QuestionController extends AppController
{
    /**
     * @var Question
     */
    protected $question;

    public function __construct()
    {
        $this->question = new Question();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->Question->orderBy('id', 'desc');
        // if ($request->has('keyword')) {
        //     $query->where(function ($q) use ($request) {
        //         $q->where('title', 'like', '%'.$request->keyword.'%')
        //             ->where('slug', 'like', '%'.$request->keyword.'%');
        //     });
        // }

        // if ($request->has('status') && $request->status != 'all') {
        //     $query->where('status', $request->status);
        // }

        // if ($request->has('Question_category_id') && $request->Question_category_id != 'all') {
        //     $query->where('Question_category_id', $request->Question_category_id);
        // }

        $paginates = $query->paginate(PAGE_NUMBER);

        // $QuestionCategories = QuestionCategory::orderBy('location', 'asc')->pluck('title', 'id');

        return view('Admin::Questions.index', compact('paginates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Question $Question)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $Question)
    {
        // return view('Admin::Questions.edit', compact('QuestionCategories'))->with('dataEdit', $Question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Question $Question, Request $request)
    {
        // try {
        //     $this->validator->with($request->all())->setId($Question->id)->passesOrFail(BaseValidatorInterface::RULE_UPDATE);
        // } catch (ValidatorException $e) {
        //     return redirect(route('admin.Questions.edit', $Question->id))->withErrors($e->getMessageBag())->withInput();
        // }

        // $formData = $request->all();
        // $Question->update($formData);

        // return redirect()->route('admin.Questions.edit', $Question->id)->with('success', __('Cập nhật thành công'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $Question)
    {
        // $Question->delete();

        // return redirect()->route('admin.Questions.index')->with('success', __('Xóa thành công'));
    }
}
