<?php

use Afzalsabbir\SlugGenerator\Traits\SlugGenerator;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('generateSlug')) {
    /**
     * Generate slug for the model.
     *
     * @param Model $model
     * @return string
     */
    function generateSlug(Model $model): string
    {
        return SlugGenerator::handle($model);
    }
}
