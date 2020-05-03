<?php

namespace App\Events;

use App\Ut_order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class NewOrderFuture implements ShouldQueue
{
    use SerializesModels;

    public $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ut_order $order)
    {
        $this->order = $order;
    }
}
