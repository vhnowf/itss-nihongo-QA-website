<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Vote;
use App\Models\Answer;
use App\Models\Bookmark;
use App\Models\QuestionHasTag;
use App\Http\Controllers\Controller;
use App\Validators\QuestionValidator;
use App\Validators\BaseValidatorInterface;
use DB;

class QuestionController extends Controller
{
    protected $question;
    protected $validator;

    public function __construct(QuestionValidator $validator)
    {
        $this->question = new Question();
        $this->validator = $validator;  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questionQuery = $this->question->where('status', 2)->with('tag', 'user', 'answer.vote', 'vote')->orderBy('created_at', 'DESC');
        $count = $this->question->where('status', 2)->count();
        $tab = $request->has('tab') ? $request->tab : '';
        if ($tab == 'upvote') {
            $questionQuery->orderBy('votes', 'DESC');
        }
        // dd($questionQuery->get());
        $questions = $questionQuery->paginate(5);
        return view('User::questions.index', compact('questions', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function askQuestion(Request $request)
    {
        return view('User::questions.ask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataForm = $request->question;
            $user = auth()->user();
            $dataForm['owner_id'] = $user->id;
            $dataForm['status'] = 2;
            
            $question = Question::create($dataForm);
            $formData['question_id'] = $question->id;
            foreach ($dataForm['tag'] as $tag_name) {
                $tag = Tag::where('name',$tag_name)->first();
                if (!$tag) {
                    $tagForm['name'] = $tag_name['value'];
                    $tag = Tag::create($tagForm);
                }
                $formData['tag_id'] = $tag->id;
                $question_has_tag = QuestionHasTag::create($formData);
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => __('Post question successfully!'),
                'redirect_url' => route('questions.index'),
            ]);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->where('id', $id)->with('tag', 'user', 'answer.user', 'answer.vote', 'vote', 'bookmark')->first();
        return view('User::questions.detail', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->where('id', $id)->with('tag')->first();
        return view('User::questions.ask', compact('question'));
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
        try {
            DB::beginTransaction();
            $dataForm = $request->question;
            $user = auth()->user();
            $question = Question::find($id);

            $question->update($dataForm);
            $formData['question_id'] = $question->id;
            $question_tag = QuestionHasTag::where('question_id', $id)->delete();
            foreach ($dataForm['tag'] as $tag_name) {
                $tag = Tag::where('name',$tag_name)->first();
                if (!$tag) {
                    $tagForm['name'] = $tag_name['value'];
                    $tag = Tag::create($tagForm);
                }
                $formData['tag_id'] = $tag->id;
                $question_has_tag = QuestionHasTag::create($formData);
            }

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => __('Edit question successfully!'),
                'redirect_url' => route('questions.detail', $question->id),
            ]);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();

        return response()->json([
            'status' => 200,
            'message' => __('Delte successfully'),
            'redirect_url' => route('questions.index')
        ]);
    }
    
    public function getTag(Request $request)
    {
        $name = $request->name;
        $tags = Tag::where('name','like', '%'.$name.'%')->with('questions')->get();

        return response()->json([
            'tags' => $tags,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $questions = $this->question->where('title','like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->with('user', 'tag', 'vote')->paginate(5);
        $count = $this->question->where('title','like', '%'.$keyword.'%')->with('user', 'tag')->count();

        return view('User::questions.search', compact('questions', 'count', 'keyword'));
    }
    
    public function updateVote(Request $request) 
    {
        $question_id = $request->question_id;
        $answer_id = $request->answer_id;
        $user_id = auth()->user()->id;
        $vote_type = $request->vote_type;
        $formData = $request->all();
        $formData['user_id'] = $user_id;

        if(!$answer_id) {
            $question_vote = Vote::where([
                ['user_id', '=', $user_id],
                ['question_id', '=', $question_id]
            ])->first();
            $question = $this->question->where('id', $question_id)->first();
            if ($question_vote) {
                if ($vote_type == $question_vote->vote_type) {
                    $question_vote->delete();
                } else {
                    $question_vote->vote_type = $vote_type;
                    $question_vote->save();
                }
            } else {
                Vote::create($formData);
            }
            $vote_count = Vote::where('question_id', '=', $question_id)->sum('vote_type');
            $question->votes = $vote_count;
            $question->save();
        } else {
            $answer_vote = Vote::where([
                ['user_id', '=', $user_id],
                ['answer_id', '=', $answer_id]
            ])->first();
            $answer = Answer::where('id', $answer_id)->first();
            if ($answer_vote) {
                if ($vote_type == $answer_vote->vote_type) {
                    $answer_vote->delete();
                } else {
                    $answer_vote->vote_type = $vote_type;
                    $answer_vote->save();
                }
            } else {
                $formData['question_id'] = null;
                Vote::create($formData);
            }
            $vote_count = Vote::where('answer_id', '=', $answer_id)->sum('vote_type');
            $answer->votes = $vote_count;
            $answer->save();
        }

        $question = $this->question->where('id', $question_id)->with('tag', 'user', 'answer.user', 'answer.vote', 'vote', 'bookmark')->first();

        return response()->json([
            'status' => 200,
            'message' => __('Thành công!'),
            'question' => $question,
        ]);
    }

    public function showTag($tag_name) {
        $tag_ids = [];
        $ids = [];
        $tags = Tag::where('name', $tag_name)->with('questions')->get();
        foreach ($tags as $tag) {
            array_push($tag_ids, $tag->id);
        }

        $question_tags = QuestionHasTag::whereIn('tag_id', $tag_ids)->get();
        foreach ($question_tags as $question_tag) {
            array_push($ids, $question_tag->question_id);
        }

        $questions = $this->question->whereIn('id', $ids)->orderBy('created_at', 'desc')->with('user', 'tag', 'vote')->paginate(5);
        $count = $this->question->whereIn('id', $ids)->orderBy('created_at', 'desc')->with('user', 'tag', 'vote')->count();

        return view('User::questions.search', compact('questions', 'count', 'tag_name'));
    }

    public function bookmark($id) {
        $bookmark = Bookmark::where([
            ['question_id', $id],
            ['user_id', auth()->user()->id]
        ])->first();
        if ($bookmark) {
            $bookmark->delete();
        } else {
            $formData['question_id'] = $id;
            $formData['user_id'] = auth()->user()->id;
            Bookmark::create($formData);
        }

        return response()->json([
            'status' => 200,
            'message' => __('Thành công!'),
        ]);
    }
}
