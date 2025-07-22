<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FilterBySearch
{
    public function applyFilters($query, Request $request, array $filters)
    {
        foreach ($filters as $field => $type) {
            $value = $request->input($field);
            if (!$value) continue;

            if ($type === 'like') {
                $query->where($field, 'LIKE', "%{$value}%");
            } elseif ($type === 'exact') {
                $query->where($field, $value);
            } elseif ($type === 'date') {
                $query->whereDate($field, $value);
            }
        }

        return $query;
    }
}
