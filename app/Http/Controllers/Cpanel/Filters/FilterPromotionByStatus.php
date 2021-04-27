<?php


namespace App\Http\Controllers\Cpanel\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FilterPromotionByStatus implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value == 'inactive') {
            $query->whereNull('published_at');
        }

        if ($value == 'active') {
            $query->whereNotNull('published_at');
        }
    }
}
