<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => 'nullable|string|min:8|max:255',
            'type' => ['required', 'string', Rule::in(UserType::cases())],
            'group_id' => 'sometimes|integer|exists:groups,id',
        ];
    }
}
