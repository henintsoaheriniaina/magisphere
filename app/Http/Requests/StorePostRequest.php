<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la requête.
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string',
            'category' => 'nullable|in:post,announcement',
            'files' => 'nullable|array',
            'files.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,mp4,mov,avi,pdf,doc,docx,txt',
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',

            'category.in' => 'La catégorie sélectionnée est invalide.',

            'files.array' => 'Les fichiers doivent être envoyés sous forme de tableau.',
            'files.*.file' => 'Chaque fichier doit être un fichier valide.',
            'files.*.max' => 'Chaque fichier ne doit pas dépasser 10MB.',
            'files.*.mimes' => 'Le fichier :attribute doit être de type : jpg, jpeg, png, gif, mp4, mov, avi, pdf, doc, docx ou txt.',
        ];
    }
}
