<?php

namespace App\Modules\Api\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MediaController extends AppController
{
    public function index(Request $request)
    {
        $query = Media::orderby('id', 'desc')->public();

        // $query->where('user_id', Auth()->user()->id);

        if ($request->has('media_filter_date') && $request->media_filter_date != 'all') {
            $query->whereMonth('created_at', date('m', strtotime($request->media_filter_date)));
            $query->whereYear('created_at', date('Y', strtotime($request->media_filter_date)));
        }

        if ($request->has('key')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->key.'%')
                    ->orWhere('url', 'like', '%'.$request->key.'%');
            });
        }

        $media_type = 'ajax';
        if ($request->has('type')) {
            $media_type = $request->type;
        }

        $page_number = 40;

        $medias = $query->paginate($page_number);

        if ($media_type == 'vue') {
            $data = [];
        } else {
            $data = '';
        }
        if ($medias->isEmpty()) {
            if ($request->page == 1) {
                $code = 204;
                $message = __('Không có dữ liệu');
                if ($media_type == 'ajax') {
                    $data = '<div class="media-empty" style="font-weight: bold; text-align: center; margin-top: 40px;">'.__('không có tệp tin nào').'</div>';
                }
            } else {
                $code = 404;
                $message = __('Không tồn tại');
            }
        } else {
            $code = 200;
            $message = __('Thành công!');

            if ($medias->count() < $page_number) {
                $page_last = true;
            }

            if ($media_type == 'vue') {
                foreach ($medias as $key => $media) {
                    array_push($data, [
                        'id' => $media->id,
                        // 'url' => $media->urlS3,
                        // 'thumbnail' => $media->thumbnailS3,
                        'url' => $media->url,
                        'thumbnail' => $media->thumbnail,
                    ]);
                }
            } else {
                foreach ($medias as $key => $media) {
                    $data .= '<li id="media-li-'.$media->id.'">'.
                        '<input type="hidden" name="value-id" id ="value-id" value="'.$media->id.'">'.
                        '<input type="checkbox" id="cb'.$media->id.'" name="check_image_media[]" value="'.$media->url.'"/>'.
                        '<label for="cb'.$media->id.'"><img src="'.$media->thumbnail.'" /></label>'.
                    '</li>';
                }
            }
        }

        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
            'page_last' => $page_last ?? false,
        ]);
    }

    public function list(Request $request)
    {
        $query = Media::orderby('id', 'desc')->public();

        if ($request->has('media_filter_date') && $request->media_filter_date != 'all') {
            $query->whereMonth('created_at', date('m', strtotime($request->media_filter_date)));
            $query->whereYear('created_at', date('Y', strtotime($request->media_filter_date)));
        }

        if ($request->has('key')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->key.'%')
                    ->orWhere('url', 'like', '%'.$request->key.'%');
            });
        }

        $page_number = 40;

        $medias = $query->paginate($page_number);

        $data = [];
        if ($medias->isEmpty()) {
            if ($request->page == 1) {
                $code = 204;
                $message = __('không có tệp tin nào');
            } else {
                $code = 404;
                $message = __('Không tồn tại');
            }
        } else {
            $code = 200;
            $message = __('Thành công!');

            if ($medias->count() < $page_number) {
                $page_last = true;
            }

            foreach ($medias as $key => $media) {
                array_push($data, [
                    'id' => $media->id,
                    'url' => $media->urlS3,
                    'thumbnail' => $media->thumbnailS3,
                ]);
            }
        }

        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
            'page_last' => $page_last ?? false,
        ]);
    }

    public function getListMonth()
    {
        $months = [];
        $today = date('Y-m-1');
        while (date('Y', strtotime($today)) >= 2020) {
            array_push($months, [
                'title' => date('F Y', strtotime($today)),
                'value' => $today,
            ]);
            $month_plus = date('Y-m-d', strtotime($today.' -1 month'));
            $today = $month_plus;
        }

        return response()->json([
            'status' => 200,
            'message' => __('Thành công.'),
            'months' => $months,
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $type = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $fileName = ((Media::orderby('id', 'desc')->first()->id ?? 0) + 1).'-'.$this->stringToSlug($imageName).'.'.$type;

            // $fileName = date('Y/m').'/'.((Media::orderby('id', 'desc')->first()->id ?? 0) + 1).'-'.time().'.'.$file->getClientOriginalExtension();
            // $url = Storage::disk('s3')->put('originals/'.$fileName, file_get_contents($file));
            // // upload thumbnail
            // $img = Image::make($file)->resize(240, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $resource = $img->stream()->detach();
            // $thumbnail = Storage::disk('s3')->put('thumbnails/'.$fileName, $resource);

            // create folder
            $folderOriginals = [
                'originals',
                date('Y'),
                date('m'),
            ];
            $originPath = $this->createFolder($folderOriginals);

            $folderThumbnails = [
                'thumbnails',
                date('Y'),
                date('m'),
            ];
            $thumbnailPath = $this->createFolder($folderThumbnails);

            if(strtolower($type) != 'svg') {
                $img = Image::make($file->path());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($thumbnailPath).$fileName);
            }

            $file->move(public_path($originPath), $fileName);

            $media = Media::create([
                'user_id' => Auth()->user()->id,
                'title' => $imageName,
                'type' => $type,
                // 'url' => 'originals/'.$fileName,
                // 'thumbnail' => 'thumbnails/'.$fileName,
                'url' => $originPath.$fileName,
                'thumbnail' => strtolower($type) == 'svg' ?  $originPath.$fileName : $thumbnailPath.$fileName,
                'caption' => $imageName,
                // 'place_storage' => 's3',
                'size' => $size,
            ]);

            // $media->url = $media->urlS3;
            // $media->thumbnail = $media->thumbnailS3;

            return response()->json([
                'status' => 200,
                'message' => __('Tải lên thành công.'),
                'data' => [
                    'id' => $media->id,
                    // 'url' => $media->urlS3,
                    'url' => $media->url,
                    'thumbnail' => $media->thumbnail,
                    // 'thumbnail' => $media->thumbnailS3,
                ],
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => __('Thiếu dữ liệu file cần tải lên.'),
            ]);
        }
    }

    // private function stringToSlug($str) {
    //     $str = trim(mb_strtolower($str));
    //     $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    //     $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    //     $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    //     $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    //     $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    //     $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    //     $str = preg_replace('/(đ)/', 'd', $str);
    //     $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    //     $str = preg_replace('/([\s]+)/', '-', $str);

    //     return $str;
    // }

    private function createFolder($arr)
    {
        $path = '/uploads/';
        foreach ($arr as $value) {
            $path .= $value.'/';
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true);
            }
        }

        return $path;
    }

    public function delete(Request $request)
    {
        Media::whereIn('id', $request->array_id)->delete();

        return response()->json([
            'status' => 200,
            'message' => __('Xóa thành công.'),
        ]);
    }
}
