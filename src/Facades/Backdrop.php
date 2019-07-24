<?php

namespace Robertgarrigos\BackdropHeadlessClient\Facades;

use Illuminate\Support\Facades\Facade;

class Backdrop extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backdrop';
    }
}
