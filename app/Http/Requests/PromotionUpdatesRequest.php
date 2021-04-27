<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionUpdatesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'promotion_type' => 'filled|string',
            'cover_image' => 'filled',
            'title' => 'filled|max:120',
            'content' => 'filled',
            'from_date' => 'filled|date',
            'to_date' => 'filled|date'
        ];
    }

    /**
     * @return array
     */
    public function validatedInputs()
    {
        $path = optional($this->file('cover_image'))->storePublicly('uploads', [
            'disk' => 'public'
        ]);

        if ($path) {
            return array_merge($this->validated(), ['cover_image' => $path]);
        }

        return $this->validated();
    }
}
