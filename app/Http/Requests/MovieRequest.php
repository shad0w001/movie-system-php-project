<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:50',
            'image' => 'image|dimensions:max_width=2000,max_height=3000',
            'status' => 'required|in:Planned,In Production,Released,Cancelled',
            'release_date' => 'date|required_if:status,Planned|required_if:status,In Production|required_if:status,Released',
            'language' => 'required|min:5|max:20',
            'score' => 'numeric|required_if:status,Released|between:0,100',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.image' => 'The movie banner must be in a valid format (jpg, jpeg, png, bmp, gif, svg, or webp).',
            'image.dimensions' => 'The dimensions of the file cannot exceede (2000px by 3000px)',
            'release_date.required_if' => 'You cannot set an expected release date to an already canceled movie.',
            'language.required' => 'You must provide an original language.',
            'score.required_if' => 'A non-released movie cannot have a valid user score.'
        ];
    }
}
