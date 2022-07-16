<?php

namespace App\Modules\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductTranslationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;

    /**
     * Create a new message instance.
     *
      * @return void
     */
    
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $product = $this->product;

        return $this->view('Admin::mails.product-translation', compact('product'))->subject(__('Đã dịch lại sản phẩm ') . $product->id . __(' theo yêu cầu của bạn'));
    }
}
