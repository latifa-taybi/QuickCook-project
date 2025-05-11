<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecetteRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'prepTime' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:facile,moyen,difficile',
            'description' => 'required|string',
            'videoUrl' => 'nullable|url',
        ];
        }

        
        /**
         * Get custom messages for validator errors.
         *
         * @return array<string, string>
         */
        public function messages(): array
        {
            return [
                'name.required' => 'Le nom est obligatoire.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
                'category.required' => 'La catégorie est obligatoire.',
                'category.string' => 'La catégorie doit être une chaîne de caractères.',
                'category.max' => 'La catégorie ne peut pas dépasser 255 caractères.',
                'prepTime.required' => 'Le temps de préparation est obligatoire.',
                'prepTime.integer' => 'Le temps de préparation doit être un entier.',
                'prepTime.min' => 'Le temps de préparation doit être au moins 1 minute.',
                'difficulty.required' => 'La difficulté est obligatoire.',
                'difficulty.string' => 'La difficulté doit être une chaîne de caractères.',
                'difficulty.in' => 'La difficulté doit être facile, moyen ou difficile.',
                'description.required' => 'La description est obligatoire.',
                'description.string' => 'La description doit être une chaîne de caractères.',
                'videoUrl.url' => 'L\'URL de la vidéo doit être une URL valide.',
            ];
        }
}
