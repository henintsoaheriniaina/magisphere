<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'lastname' => 'required|string|max:255',
            'matriculation' => [
                'required',
                'string',
                'unique:users',
                'regex:/^(ETSI|ETS|SE)-\d{2,4}$/'
            ],
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users',
            'affiliation' => 'required|exists:affiliations,id',
        ];
    }
    public function messages()
    {
        return  [
            'firstname.required' => 'Le champ prénom est obligatoire.',
            'firstname.string' => 'Le champ prénom doit être une chaîne de caractères.',
            'firstname.max' => 'Le champ prénom ne doit pas dépasser 255 caractères.',
            'lastname.required' => 'Le champ nom est obligatoire.',
            'lastname.string' => 'Le champ nom doit être une chaîne de caractères.',
            'lastname.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
            'matriculation.required' => 'Le champ matriculation est obligatoire.',
            'matriculation.string' => 'Le champ matriculation doit être une chaîne de caractères.',
            'matriculation.unique' => 'Cette matriculation est déjà utilisée.',
            'matriculation.regex' => 'Le format de la matriculation est incorrect',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.string' => 'Le champ email doit être une chaîne de caractères.',
            'email.email' => 'Le champ email doit être une adresse email valide.',
            'email.max' => 'Le champ email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'affiliation.required' => 'Le champ affiliation est obligatoire.',
            'affiliation.exists' => 'La valeur de l\'affiliation est invalide.',
        ];
    }
}
