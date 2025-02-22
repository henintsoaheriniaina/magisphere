<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserProfileRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'matriculation' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->user()->id),
                'regex:/^(ETSI|ETS|SE)-\d{4}$/'
            ],
            "class" => "nullable|string|max:255",
            "bio" => "nullable|string|max:2000",
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le champ prénom est obligatoire.',
            'firstname.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'firstname.max' => 'Le champ prénom ne doit pas dépasser 255 caractères.',

            'lastname.string' => 'Le champ nom doit être une chaîne de caractères.',
            'lastname.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',

            'matriculation.required' => 'Le champ matriculation est obligatoire.',
            'matriculation.string' => 'Le champ matriculation doit être une chaîne de caractères.',
            'matriculation.unique' => 'Cette matriculation est déjà utilisée.',
            'matriculation.regex' => 'Le format de la matriculation est incorrect. Il doit suivre le format ETSI-XXXX, ETS-XXXX ou SE-XXXX.',

            'class.string' => 'Le champ classe doit être une chaîne de caractères.',
            'class.max' => 'Le champ classe ne doit pas dépasser 255 caractères.',

            'bio.string' => 'Le champ biographie doit être une chaîne de caractères.',
            'bio.max' => 'Le champ biographie ne doit pas dépasser 2000 caractères.',
        ];
    }
}
