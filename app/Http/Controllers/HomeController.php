<?php

namespace App\Http\Controllers;

use App\Mail\errorMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function error400()
    {
        return view('errors.404');
    }

    public function error500()
    {
        return view('errors.500');
    }

    public function sendMailError(Request $request)
    {
        $pageURL = $_SERVER["HTTP_REFERER"];
        $status = $request->errorNumber;
        $isSent404 = strpos($pageURL, "/error-400") > 0 ? true : false;
        $isSent500 = strpos($pageURL, "/error-500") > 0 ? true : false;

        if ($isSent404 || $isSent500) {
            return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi phản hồi đến Vinavi. Phản hồi của bạn đã được gửi đi trước đó.');
        } else if (!$isSent404) {
            if ($request->page == STATUS_ERROR_404) {
                $detail = [
                    'title' => 'Error 404 ',
                    'body' => 'Thông báo trang không tồn tại. Admin vui lòng kiểm tra lại!',
                    'url' => $request->url
                ];
            } else if ($request->page == STATUS_ERROR_500) {
                $detail = [
                    'title' => 'Error 500 ',
                    'body' => 'Thông báo trang không thể truy cập do Server bị lỗi. Admin vui lòng kiểm tra lại!',
                    'url' => $request->url
                ];
            }

            Mail::to("Vinavi.store@gmail.com")->send(new errorMail($detail));

            if ($request->page == STATUS_ERROR_404) {
                return redirect()->route('error-400')->with('success', 'Cảm ơn bạn đã gửi phản hồi đến Vinavi. Chúng tôi sẽ xử lý nhanh nhất có thể.');
            } else if ($request->page == STATUS_ERROR_500) {
                return redirect()->route('error-500')->with('success', 'Cảm ơn bạn đã gửi phản hồi đến Vinavi. Chúng tôi sẽ xử lý nhanh nhất có thể.');
            }
        }
    }
}
