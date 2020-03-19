<?php

namespace App\Observers;

use App\Flight;
use Illuminate\Support\Facades\Log;

class FlightObserver
{
    /**
     * Handle the flight "created" event.
     *
     * @param  \App\Flight  $flight
     * @return void
     */
    public function created(Flight $flight)
    {
        //
    }

    /**
     * Handle the flight "updated" event.
     *
     * @param  \App\Flight  $flight
     * @return void
     */
    public function updated(Flight $flight)
    {
        //
    }

    /**
     * Handle the flight "deleted" event.
     *
     * @param  \App\Flight  $flight
     * @return void
     */
    public function deleted(Flight $flight)
    {
       Log::info("航班已经删除。" . $flight->id . ' - ' . $flight->name);
    }

    /**
     * Handle the flight "restored" event.
     *
     * @param  \App\Flight  $flight
     * @return void
     */
    public function restored(Flight $flight)
    {
        //
    }

    public function saved(Flight $flight)
    {
        Log::info("航班已经保存。" . $flight->id . ' - ' . $flight->name);
    }

    public function retrieved(Flight $flight)
    {
        Log::info("航班已查询。" . $flight->id . ' - ' . $flight->name);
    }

    /**
     * Handle the flight "force deleted" event.
     *
     * @param  \App\Flight  $flight
     * @return void
     */
    public function forceDeleted(Flight $flight)
    {
        //
    }
}
