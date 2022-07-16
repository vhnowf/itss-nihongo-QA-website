<?php

namespace App\Modules\Api\Http\Controllers;

use App\Models\SubscribeEmail;
use Illuminate\Http\Request;


class SubscribeEmailController extends AppController
{
    public function create(Request $request)
    {   
        $subcribe_email = SubscribeEmail::where('email', $request->email)->first();

        if(!isset($subcribe_email)){
            $subcribe_email =  SubscribeEmail::create([
                'email' => $request->email,
            ]);
        }

        return json_encode([
            'status' => 200,
            'message' => __('Cám ơn bạn đã đăng ký. Chúng tôi sẽ gửi cho bạn ngay khi có chương trình khuyến mại'),
        ]);
    }
}
