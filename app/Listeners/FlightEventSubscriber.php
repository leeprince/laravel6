<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\{
    FlightDeleted,
    FlightSaved};
use Illuminate\Support\Facades\Log;


class FlightEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * [监听删除]
     *
     * @Author  leeprince:2020-02-19 10:26
     */
    public function onFlightDeleted($event)
    {
        Log::info("航班已经删除。" . $event->flight->id . ' - ' . $event->flight->name);

    }

    /**
     * [监听修改]
     *
     * @Author  leeprince:2020-02-19 10:26
     */
    public function onFlightSaved($event)
    {
        Log::info("航班已经修改。".$event->flight->id.' - '.$event->flight->name);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * [事件订阅者 - 为订阅者注册监听器]
     *
     * @Author  leeprince:2020-02-19 10:40
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            FlightDeleted::class,
            FlightEventSubscriber::class.'@onFlightDeleted'
        );
        $events->listen(
            FlightSaved::class,
            FlightEventSubscriber::class.'@onFlightSaved'
        );
    }
}
