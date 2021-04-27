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
            'cover_image' => 'required|image',
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
    public function validatedInputs()
    {
        $path = $this->file('cover_image')->storePublicly('uploads', [
            'disk' => 'public'
        ]);

        if (!$path) {
            throw ValidationException::withMessages(['cover_image' => 'Upload image cover failed.']);
        }

        return array_merge($this->validated(), ['cover_image' => $path]);
    }
}
