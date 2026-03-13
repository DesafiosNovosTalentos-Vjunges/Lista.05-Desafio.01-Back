<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NotificationLog;
use App\Jobs\SendOrderNotificationJob;

class RetryFailedNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    private $signature = 'notifications:retry-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    private $description = 'Reenvia as notificações de pedidos que falharam (status failed)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $failed_logs = NotificationLog::with('order')->where('status', 'failed')->get();

        if($failed_logs->isEmpty()){
            $this->info('Ótimo!! Não possuem notificações falhas para reenviar.');
            return;
        }

        $this->info("Encontradas {$failedLogs->count()} notificações falhas. Reiniciando o envio!");

        foreach($failed_logs as $log){
            if($log->order){
                SendOrderNotificationJob::dispatch($log->order);
                $this->info("Mandando um novo job para o pedido ID: {$log->order->id}");
            }
        }
        $this->info('Concluido com sucesso! As tentativas de reenvio foram enviadas para a fila');
    }
}
