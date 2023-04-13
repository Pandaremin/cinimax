<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'cover' => 'required',
            'overview' => 'required',
            'rating' => 'required',
            'release_date' => 'required',
            'duration' => 'required',
            'trailer' => 'required',
            'content_type' => 'required',
            'publish' => 'required|boolean',
            'featured' => 'required|boolean',
            'premium_only' => 'required|boolean',
            'genre' => 'required',
            'linktitle' => 'required',
            'type' => 'required',
            'link' => 'required',
        ];
    }
}
