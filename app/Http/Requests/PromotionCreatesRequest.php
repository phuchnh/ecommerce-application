<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

    /**
     * @return array
     * @throws ValidationException
     */
    public function fromCreateRequest()
    {
        $path = $this->file('img_cover')->storePublicly('promotions/img_covers', [
            'disk' => 'public'
        ]);

        if (!$path) {
            throw ValidationException::withMessages(['img_cover' => 'Upload image cover failed.']);
        }

        return array_merge($this->validated(), ['img_cover' => $path]);
    }
}
