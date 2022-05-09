<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Jobs;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCakeSubscription implements ShouldQueue, ShouldBeUnique
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

    public function uniqueId(): string
    {
        return "[$this->email]-[{$this->cake->id}]";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $alreadySubscribed = $this->cake->subscriptions()
            ->where('email', $this->email)
            ->exists();

        if ($alreadySubscribed) {
            return;
        }

        $this->cake->subscriptions()->create([
            'email' => $this->email,
        ]);
    }
}
