<?php

namespace App\Listeners;

use App\Events\ProductViewEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Session\Store;

class ListenProductViewEvent
{
    private $session;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  ProductViewEvent  $event
     * @return void
     */
    public function handle(ProductViewEvent $event)
    {
        if (!$this->isProductViewed($event->product))
        {
            // $event->productView = new ProductView;
            $user = auth()->user();
            if ($user) {
                $event->productView->user_id = $user->id;
            }
            $event->productView->product_id = $event->product->id;
            $event->productView->ip = $_SERVER['REMOTE_ADDR'];
            $event->productView->save();
            $this->storeProduct($event->product);
        }
    }

    private function isProductViewed($product)
    {
        $viewed = $this->session->get('viewed_products', []);

        return array_key_exists($product->id, $viewed);
    }

    private function storeProduct($product)
    {
        $key = 'viewed_products.' . $product->id;

        $this->session->put($key, time());
    }
}
