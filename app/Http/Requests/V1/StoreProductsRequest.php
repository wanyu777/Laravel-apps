<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif']
        ];
    }

        public function handleImageUpload(): ?string
        {
            if ($this->hasFile('image')) {
                return $this->file('image')->store('products', 'public');
            }
            return null;
        }

}
