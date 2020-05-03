<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

use App\Order;

class OrderFutureRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $order;
    protected $taxi_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $taxi_id)
    {
        $this->order = $order;
        $this->taxi_id = $taxi_id;
    }

}
