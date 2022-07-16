<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::with('questions');
        $tab = $request->has('tab') ? $request->tab : '';
        if ($tab == 'new') {
            $query->orderBy('created_at', 'DESC');
        } else if ($tab == 'name') {
            $query->orderBy('name', 'ASC');
        } else {
            $query = Tag::select('tags.*', DB::raw('COUNT(question_tag.tag_id) AS count_tag'))
                ->join('question_tag', 'tags.id', 'question_tag.tag_id')
                ->groupBy('question_tag.tag_id')
                ->orderBy('count_tag', 'DESC')
                ->with('questions');
        }
        if ($request->keyword) {
            $query->where('name', 'like', '%'.$request->keyword.'%');
        }
        $tags = $query->paginate(PAGE_NUMBER);
        $tag_count = Tag::whereDate('created_at', Carbon::today())->count();

        return view('User::layouts.tags', compact('tags'));
    }
}
