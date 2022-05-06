<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Jobs;

use App\Models\Cake;
use App\Notifications\CakeOutOfStockNotification;
use App\Notifications\CakeRequestedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ProcessCakeSolicitation implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private Cake $cake,
        private string $email,
    ) {
        //
    }

    public function uniqueId(): int
    {
        return $this->cake->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->cake->refresh();
        if ($this->cake->quantity > 0) {
            $this->cake->solicitations()
                ->create([
                    'email' => $this->email,
                ]);

            Notification::route('mail', $this->email)
                ->notify(new CakeRequestedNotification($this->cake->name));
        } else {
            Notification::route('mail', $this->email)
                ->notify(new CakeOutOfStockNotification($this->cake->name));
        }
    }
}
