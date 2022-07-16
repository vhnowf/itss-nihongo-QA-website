<?php

namespace App\Modules\Api\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\KeywordSearch;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
class UserController extends AppController
{
    /**
     * @var UserValidator
     */
    protected $userValidator;

    public function __construct(UserValidator $userValidator)
    {
        $this->userValidator = $userValidator;
        $this->keyword_search = new KeywordSearch();

    }
    public function getKeywordSearch(Request $request) {
        $user_id = Auth::user()->id ?? null;
        $keyword = $request->keyword;
        if(empty($request->keyword)) {
            $hot_keywords = $this->keyword_search->getSearchKeyword($request, null, $take=5);
            
            $user_keywords = [];
            if(Auth::user()){
                $user_keywords = $this->keyword_search->getSearchKeyword($request, $user_id, $take=5 );
            }

            $view = view("User::includes.popup-keyword",compact('hot_keywords', 'user_keywords'))->render();

            return response()->json([
                'status' => 200,
                'html' => $view,
            ]);
        }
        
        $user_keywords = $this->keyword_search->getSearchKeyword($request, $user_id, $take=10, $keyword );  
        $hot_keywords = [];
        if(count($user_keywords) < 10){
            $count_hot_keywords = 10 - count($user_keywords);

            $hot_keywords = $this->keyword_search->getSearchKeyword($request, null, $take = $count_hot_keywords, $keyword );  

            if(count($user_keywords) + count($hot_keywords) < 10 ){
                $count_products = 10 - count($user_keywords) - count($hot_keywords);

                $products = Product::where('title', 'like', '%'.$keyword.'%')->take($count_products)->orderBy('id', 'desc')->get();

                $view = view("User::includes.popup-keyword",compact('hot_keywords', 'user_keywords', 'products', 'keyword'))->render();

                return response()->json([
                    'status' => 200,
                    'html' => $view,
                ]);
            }
            $view = view("User::includes.popup-keyword",compact('hot_keywords', 'user_keywords','keyword'))->render();

            return response()->json([
                'status' => 200,
                'html' => $view,
            ]);
        }
        else{
            $view = view("User::includes.popup-keyword",compact('hot_keywords', 'user_keywords', 'keyword'))->render();
            
            return response()->json([
                'status' => 200,
                'html' => $view,
            ]);
        }
    }
}
