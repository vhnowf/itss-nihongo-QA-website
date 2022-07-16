<?php

namespace App\Modules\User\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends AppController
{
    public function index()
    {
        $meta = $this->getMeta();

        return view('User::homes.index', compact('meta'));
    }

    public function landingPage()
    {
        $meta = $this->getMeta();
        $meta['title'] = __('Hướng dẫn mua hàng');
        $meta['og_image'] = asset('/images/lps/banner.png');

        return view('User::homes.landing-page', compact('meta'));
    }

    public function search(Request $request)
    {
        if ($request->keyword != '') {
            $user = Auth::user();
            if ($user) {
                $user_id = $user->id;
            } else {
                $user_id = null;
            }

            $keyword_search = KeywordSearch::where('key', $request->keyword)->first();
            if (!$keyword_search) {
                $keyword_search = KeywordSearch::create([
                    'key' => $request->keyword,
                ]);

                $keyword_search_detail = KeywordSearchDetail::create([
                    'keyword_search_id' => $keyword_search->id,
                    'user_id' => $user_id,
                    'count' => 1,
                ]);
            } else {
                $keyword_search_detail = KeywordSearchDetail::where(['keyword_search_id' => $keyword_search->id, 'user_id' => $user_id])->first();
                if (!$keyword_search_detail) {
                    $keyword_search_detail = KeywordSearchDetail::create([
                        'keyword_search_id' => $keyword_search->id,
                        'user_id' => $user_id,
                        'count' => 1,
                    ]);
                } else {
                    $keyword_search_detail->count = $keyword_search_detail->count + 1;
                    $keyword_search_detail->save();
                }
            }
        }

        // $products = $this->product->getSearch($request, true);
        $categories = Category::where('slug', '!=', 'loai-khac')
            ->whereParentId(0)->with([
                'childs' => function($q) {
                    $q->with('childs');
                }
            ])
            ->orderBy('location', 'asc')
            ->get();
        $companies = Company::active()->orderby('title', 'asc')->get();
        $filterData = [
            'keyword' => $request->keyword ?? null,
            'price_min' => $request->price_min ?? null,
            'price_max' => $request->price_max ?? null,
            'sort' => $request->sort ?? null,
            'page' => $request->page ?? 1,
        ];
        if ($request->has('categories') && !empty($request->categories)) {
            $filterData['categories'] = explode(',', $request->categories);
        } else {
            $filterData['categories'] = [];
        }
        if ($request->has('companies') && !empty($request->companies)) {
            $filterData['companies'] = explode(',', $request->companies);
        } else {
            $filterData['companies'] = [];
        }

        return view('User::homes.search', compact('companies', 'categories', 'filterData'));
    }

    public function detail(Request $request, $slug)
    {
        $breadcrumbs = [
            [
                'title' => __('Home'),
                'url' => url('/'),
            ],
        ];

        $meta = $this->getMeta();

        // Chi tiết sản phẩm
        $product = Product::where('id', $slug)
            ->with('images', 'category', 'company', 'vi', 'ja')
            // ->public()
            ->first();
        if ($product) {
            if ($product->category) {
                if ($product->category->id != 0 && $product->category->parent) {
                    array_push($breadcrumbs, [
                        'title' => $product->category->parent->title,
                        'url' => route('homes.detail', $product->category->parent->slug),
                    ]);
                }
                array_push($breadcrumbs, [
                    'title' => $product->category->title,
                    'url' => route('homes.detail', $product->category->slug),
                ]);
            }
            array_push($breadcrumbs, [
                'title' => $product->title,
                'url' => route('homes.detail', $product->slug ?? $product->id),
            ]);

            $meta['title'] = !empty($product->vi->seo_title) ? $product->vi->seo_title : $product->vi->title;
            $meta['keywords'] = $product->seo_keywords;
            $meta['description'] = $product->seo_description;
            $meta['og_image'] = asset($product->avatar);

            $listCategoryProducts = Product::public()
                ->where('category_id', $product->category_id)
                ->where('company_id', '!=', $product->company_id)
                ->with('images', 'category', 'vi', 'ja', 'company')
                ->whereNotIn('id', [$product->id])
                ->take(4)
                ->get();

            $listCompanyProducts = Product::public()
                // ->where('category_id', '!=', $product->category_id)
                ->where('products.company_id', $product->company_id)
                ->with('images', 'category', 'vi', 'ja', 'company')
                ->whereNotIn('products.id', [$product->id])
                ->take(4)
                ->get();

            // Đếm số lượt xem
            $productView = new ProductView();
            event(new ProductViewEvent($productView, $product));

            $listViewedProduct = [];
            if(Auth::user()) {
                $user_id = Auth::user()->id;
                $listViewed = ProductView::where('user_id', '=', $user_id)
                    ->groupby('product_id')
                    ->orderBy('id', 'DESC')
                    ->with('product')
                    ->take(4)
                    ->get();
               
                foreach ($listViewed as $listViewed) {
                    array_push($listViewedProduct, $listViewed->product);
                }
            }
            

            return view('User::homes.product', compact('product', 'breadcrumbs', 'meta', 'listCategoryProducts', 'listCompanyProducts', 'listViewedProduct'));
        }

        // Loại sản phẩm
        $category = Category::whereSlug($slug)->with([
            'childs' => function($q) {
                $q->with('childs');
            }
        ])->first();
        if ($category) {
            if ($category->parent) {
                array_push($breadcrumbs, [
                    'title' => $category->parent->title,
                    'url' => route('homes.detail', $category->parent->slug),
                ]);
            }

            array_push($breadcrumbs, [
                'title' => $category->title,
                'url' => 'javascript:void(0)',
            ]);

            $meta['title'] = empty($category->vi->seo_title) ? $category->seo_title : $category->title;
            $meta['keywords'] = $category->seo_keywords;
            $meta['description'] = $category->seo_description;
            $meta['og_image'] = asset($category->avatar);

            // $categories = Category::where('slug', '!=', 'loai-khac')
            //    ->with([
            //         'childs' => function($q) {
            //             $q->with('childs');
            //         }
            //     ])
            //     ->orderBy('location', 'asc')
            //     ->get();
            $categories = $category->childs;
            $companies = Company::select('companies.*', \DB::raw('COUNT(products.id) as count_product'))
                ->join('products', 'products.company_id', '=', 'companies.id')
                ->where('products.status', STATUS_PUBLIC)
                ->where('products.category_id', $category->id)
                ->active()
                ->groupBy('companies.id')
                ->orderby('companies.title', 'asc')
                ->get();

            $filterData = [
                'keyword' => $request->keyword ?? null,
                'price_min' => $request->price_min ?? null,
                'price_max' => $request->price_max ?? null,
                'sort' => $request->sort ?? null,
                'page' => $request->page ?? 1,
                'types' => ['category'],
                'category_parent_id' => $category->id,
            ];

            if ($request->has('categories') && !empty($request->categories)) {
                $filterData['categories'] = explode(',', $request->categories);
            } else {
                $filterData['categories'] = [];
            }

            if ($request->has('companies') && !empty($request->companies)) {
                $filterData['companies'] = explode(',', $request->companies);
            } else {
                $filterData['companies'] = [];
            }

            $hideItem = [
                // 'categories' => true
            ];
            if ($categories->count() == 0) {
                $hideItem['categories'] = true;
            }

            return view('User::homes.search', compact('meta', 'breadcrumbs', 'categories', 'companies', 'filterData', 'hideItem'));
        }

        // công ty
        $company = Company::whereSlug($slug)->first();
        if ($company) {
            array_push($breadcrumbs, [
                'title' => $company->title,
                'url' => 'javascript:void(0)',
            ]);
            $meta['title'] = $company->title;
            // $meta['keywords'] = $company->seo_keywords;
            // $meta['description'] = $company->seo_description;
            $meta['og_image'] = asset($company->avatar);

            $categoryDatas = Category::select('categories.*', \DB::raw('COUNT(products.id) as count_product'))
                ->join('products', 'products.category_id', '=', 'categories.id')
                ->where('products.status', STATUS_PUBLIC)
                ->where('products.company_id', $company->id)
                ->groupBy('categories.id')
                ->orderby('categories.title', 'asc')
                ->get();
            $cIdArr = [];
            foreach ($categoryDatas as $item) {
                if ($item->parent_id == 0) {
                    array_push($cIdArr, $item->id);
                } else {
                    if (!in_array($item->parent_id, $cIdArr)) {
                        array_push($cIdArr, $item->parent_id);
                    }
                }
            }
            $categories = Category::where('slug', '!=', 'loai-khac')
                ->whereParentId(0)
                ->whereIn('id', $cIdArr)
                ->with('childs')
                ->orderBy('location', 'asc')
                ->get();

            $companies = Company::active()->orderby('title', 'asc')->get();

            $filterData = [
                'keyword' => $request->keyword ?? null,
                'price_min' => $request->price_min ?? null,
                'price_max' => $request->price_max ?? null,
                'sort' => $request->sort ?? null,
                'page' => $request->page ?? 1,
                'companies' => [$company->id],
            ];

            if ($request->has('categories') && !empty($request->categories)) {
                $filterData['categories'] = explode(',', $request->categories);
            } else {
                $filterData['categories'] = [];
            }

            $hideItem = [
                'companies' => true,
            ];

            return view('User::homes.search', compact('meta', 'breadcrumbs', 'categories', 'company', 'companies', 'filterData', 'hideItem'));
        }

        // Trang tĩnh
        $page = Page::whereSlug($slug)->first();
        if ($page) {
            $meta['title'] = empty($page->seo_title) ? $page->seo_title : $page->title;
            $meta['keywords'] = $page->seo_keywords;
            $meta['description'] = $page->seo_description;
            $meta['og_image'] = asset($page->avatar);

            array_push($breadcrumbs, [
                'title' => $page->title,
                'url' => 'javascript:void(0)',
            ]);

            return view('User::homes.page', compact('meta', 'breadcrumbs', 'page'));
        }

        abort(404);
    }

    public function contact()
    {
        $meta = $this->getMeta();
        $breadcrumbs = [
            [
                'title' => __('Home'),
                'url' => url('/'),
            ],
            [
                'title' => __('Liên hệ'),
                'url' => 'javascript:void(0)',
            ],
        ];

        return view('User::homes.contact', compact('breadcrumbs'));
    }
}
