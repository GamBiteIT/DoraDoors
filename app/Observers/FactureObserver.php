<?php

namespace App\Observers;

use App\Models\FactureDoors;

class FactureObserver
{
    /**
     * Handle the FactureDoors "created" event.
     */
    public function created(FactureDoors $factureDoors): void
    {
        $factureDoors->$price_net = $factureDoors->$price_in - $factureDoors->$price_out; 
    }

    /**
     * Handle the FactureDoors "updated" event.
     */
    public function updated(FactureDoors $factureDoors): void
    {
        //
    }

    /**
     * Handle the FactureDoors "deleted" event.
     */
    public function deleted(FactureDoors $factureDoors): void
    {
        //
    }

    /**
     * Handle the FactureDoors "restored" event.
     */
    public function restored(FactureDoors $factureDoors): void
    {
        //
    }

    /**
     * Handle the FactureDoors "force deleted" event.
     */
    public function forceDeleted(FactureDoors $factureDoors): void
    {
        //
    }
}
