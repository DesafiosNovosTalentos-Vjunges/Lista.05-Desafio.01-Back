<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\NotificationLog;
use App\Mail\OrderNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendOrderNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $back_off = 10;

    private Order $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = "O seu pedido foi recebido e o status atual é: {$this->order->status}.";

        try {
            Mail::to($this->order->user->email)->send(new OrderNotificationMail($this->order, $message));

            NotificationLog::create([
                'user_id' => $this->order->user_id,
                'order_id' => $this->order->id,
                'message' => $message,
                'status' => 'sent',
                'attempts' => $this->attempts(),
            ]);
        } catch (Exception $e){
            if($this->attempts() >= $this->tries) {
                NotificationLog::create([
                    'user_id' => $this->order->user_id,
                    'order_id' => $this->order->id,
                    'message' => 'Falha ao enviar: ' . $e->getMessage(),
                    'status' => 'failed',
                    'attempts' => $this->attempts(),
                ]);
            }
            throw $e;
        }
    }
}
