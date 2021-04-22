<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCreatesRequest extends FormRequest
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
            'promotion_type' => 'required',
            'img_cover' => 'required|image',
            'title' => 'required|max:120',
            'content' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date'
        ];
    }
}
