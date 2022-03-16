<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
     /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Client  $table
     * @return void
     */
    public function creating(Client $table)
    {
        $table->uuid = Str::uuid();
    }
}
