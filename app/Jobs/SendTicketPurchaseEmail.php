<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TicketPurchaseEmail;
use App\Models\PurchasedTicket;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Log;

class SendTicketPurchaseEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $purchasedTicket;
    protected $email;

    public function __construct(PurchasedTicket $purchasedTicket, $email)
    {
        $this->purchasedTicket = $purchasedTicket;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(Mailer $mailer): void
    {
        $mailer->to($this->email)->send(new TicketPurchaseEmail($this->purchasedTicket));
    }

    public function failed()
    {
        Log::error('Failed to send email for ticket purchase', ['ticket' => $this->purchasedTicket]);
    }

}
