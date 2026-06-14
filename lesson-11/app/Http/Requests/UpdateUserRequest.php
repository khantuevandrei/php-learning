<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user'); // get user from url

        return [
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'age' => 'required|integer|min:1|max:120'
        ];
    }
}
