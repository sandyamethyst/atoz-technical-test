<?php

namespace ATOZ\Jobs;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use ATOZ\OrderDetail;

class CancelPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        OrderDetail::where('status', config('global.STATUS_WAITING'))
        ->where('created_at', '<=', Carbon::now()->subMinutes(5)->toDateTimeString())
        ->update(['status' => config('global.STATUS_CANCELED')]);
    }
}
