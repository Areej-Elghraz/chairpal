<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'    => 'sometimes|nullable|exists:categories,id',
            'has_categories' => 'sometimes|nullable|boolean',
            'has_places'     => 'sometimes|nullable|boolean',
            // 'owner_id'    => 'sometimes|nullable|exists:users,id',
            'country_id'     => 'sometimes|nullable|exists:countries,id',
            'city_id'        => 'sometimes|nullable|exists:cities,id',
            // Date range
            'created_from'   => 'sometimes|date',
            'created_to'     => 'sometimes|date|after_or_equal:created_from',
            // Counts
            'min_categories' => 'sometimes|integer|min:0',
            'min_places'     => 'sometimes|integer|min:0',
            // Sorting
            'sort_by'        => 'sometimes|string|in:name,created_at',
            'sort_direction' => 'sometimes|string|in:asc,desc',
            // Pagination
            'pagination'     => 'sometimes|integer|min:1|max:100',
            'limit'          => 'sometimes|integer|min:1|max:100',
            // Search
            'search'         => 'sometimes|nullable|string|max:255',
        ];
    }
}
