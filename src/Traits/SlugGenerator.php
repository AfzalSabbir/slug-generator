<?php

namespace Afzalsabbir\SlugGenerator\Traits;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static creating(Closure $param)
 * @method static updating(Closure $param)
 */
trait SlugGenerator
{
    /**
     * Boot the trait SlugGenerator.
     *
     * @return void
     */
    public static function bootSlugGenerator(): void
    {
        static::creating(function ($model) {
            if ($model->slugGenerator['set-on-create'] ?? config("sluggenerator.set-on-create")) {
                $model->handle($model);
            }
        });

        static::updating(function ($model) {
            if ($model->slugGenerator['set-on-update'] ?? config("sluggenerator.set-on-update")) {
                $model->handle($model);
            }
        });
    }

    /**
     * Handle the slug generation.
     *
     * @param Model $model
     * @return string
     */
    public function handle(Model $model): string
    {
        try {
            $targetField = $model->slugGenerator['target-field'] ?? config("sluggenerator.target-field");
            $separator   = $model->slugGenerator['separator'] ?? config("sluggenerator.separator");
            $slugField   = $model->slugGenerator['slug-field'] ?? config("sluggenerator.slug-field");

            return $model->generateSlug(null, $slugField, $targetField, $separator);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Generate slug for the model.
     *
     * @param string|null $value
     * @param string $slugField
     * @param string $targetField
     * @param string $separator
     * @return string
     */
    protected function generateSlug(string $value = null, string $slugField = 'slug', string $targetField = 'name', string $separator = '-'): string
    {
        try {
            $value = $value ?? $this->attributes[$targetField];
            $slug  = Str::slug($value, $separator);

            $count = $this->query()
                ->where('id', '!=', $this->attributes['id'] ?? null)
                ->whereRaw("$slugField RLIKE '^$slug(-[0-9]+)?$'")
                ->count();

            $slug = $count
                ? "$slug-$count"
                : $slug;

            $this->attributes[$slugField] = $slug;
        }
        catch (\Exception $e) {
            return '';
        }

        return $slug;
    }
}
