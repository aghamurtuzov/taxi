<?php

namespace App\Jobs;

use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Api\StaticController;
use App\Ut_order;
use App\Ut_order_queue;
use App\Ut_order_status_history;
use App\Ut_order_taxi_temp;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReminderFutureOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ut_order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Ut_order $order)
    {
        $this->order = $order;
        $taxies = [];

        $queues = Ut_order_queue::where('order_id', $this->order->id)->get();

        foreach ($queues as $queue) {
            $taxi = Ut_taxi::where('id', $queue->taxi_id)->get()->last();
            array_push($taxies, $taxi);
        }

        $resultsCollection = collect($taxies);

        $categories = Ut_taxi_categories::orderBy('sort', 'ASC')->get();

        if (count($taxies)) {
            foreach ($categories as $category) {
                $filtered = $resultsCollection->where('category', $category->id);
                if (count($filtered)) {
                    //priority si en cox olan taxi
                    $maxPriorityTaxi = $filtered->sortBy('priority')->values()->last();
                }
            }
            $order_status_id = Ut_order_status_history::insertGetId([
                'order' => $this->order->id,
                'taxi' => $maxPriorityTaxi->id,
                'user_id' => 13,
                'status' => 1,
                'reason' => 'Ön sifariş üçün taksi tapdi',
                'date' => date('Y-m-d H:i:s'),
                'location' => $this->order->orderDetailName->locationName()
            ]);

            $order_temp_id = Ut_order_taxi_temp::insertGetId([
                'taxi_id' => $maxPriorityTaxi->id,
                'order_id' => $this->order->id,
            ]);

            $order_queue_id = Ut_order_queue::where(['order_id' => $this->order->id, 'taxi_id' => $maxPriorityTaxi->id])->update([
                'o' => 1,
            ]);

            $orders = StaticController::getTaxiOrderFuture();
            FcmController::notification(700, '/topics/taxi', 'Basliq', 'Metn', $orders);
        }
    }
}
