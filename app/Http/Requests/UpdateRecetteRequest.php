<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecetteRequest extends FormRequest
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
            'description' => 'required|string',
            // 'prepTime' => 'required|integer',
            // 'difficulty' => 'required|in:facile,moyen,difficile',
            // 'category' => 'required|in:entree,plat,dessert,boisson,aperitif',
            // 'image' => 'nullable|image|max:10240',
            // 'videoUrl' => 'nullable|url',
            // 'regimes' => 'array',
            // 'regimes.*' => 'exists:regimes,id'
        ];
    }
}
