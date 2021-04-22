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
            'promotion_type' => 'required',
            'img_cover' => 'required',
            'title' => 'required',
            'content' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ];
    }
}
