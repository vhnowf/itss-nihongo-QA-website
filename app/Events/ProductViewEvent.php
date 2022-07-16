<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\Product;
use App\Models\ProductView;

class ProductViewEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $productView;
    public $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ProductView $productView,Product $product)
    {
        $this->productView = $productView;
        $this->product = $product;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
