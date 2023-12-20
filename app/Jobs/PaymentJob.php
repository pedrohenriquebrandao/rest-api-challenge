<?php

namespace App\Jobs;

use App\Mail\PaymentMailable;
use AWS\CRT\HTTP\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $client;
    protected $amount;
    protected $description;

    /**
     * Create a new job instance.
     */
    public function __construct(string $client, string $amount, string $description)
    {
        $this->client = $client;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('notification@test.com')->send(new PaymentMailable($this->client, $this->amount, $this->description));
    }
}
