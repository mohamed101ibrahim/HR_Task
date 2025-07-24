<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Employee;

class EmployeeObserver
{

    public function saved(Employee $employee): void
    {
        Cache::flush();
    }

    /**
     * Handle the Employee "updated" event.
     */
    public function updated(Employee $employee): void
    {
        //
    }

    /**
     * Handle the Employee "deleted" event.
     */
    public function deleted(Employee $employee): void
    {
        Cache::flush();

    }

    /**
     * Handle the Employee "restored" event.
     */
    public function restored(Employee $employee): void
    {
        Cache::flush();
    }

    /**
     * Handle the Employee "force deleted" event.
     */
    public function forceDeleted(Employee $employee): void
    {
        Cache::flush();
    }
}