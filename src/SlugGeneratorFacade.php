<?php

namespace Afzalsabbir\SlugGenerator;

use Illuminate\Support\Facades\Facade;

class SlugGeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SlugGenerator';
    }
}
