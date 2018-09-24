<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'picture' => 'image',
            'post_type' => ['required', Rule::in(['formation', 'stage'])],
            'title' => 'bail|required|min:2|max:255',
            'description' => 'required|min:10',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric|min:0',
            'max_students' => 'required|integer|min:0',
            'category_id' => 'required',
            'status' => 'nullable'
        ];
    }
}
