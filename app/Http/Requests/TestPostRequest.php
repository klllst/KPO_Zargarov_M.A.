<?php

namespace App\Http\Requests;

use App\Enums\TestType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestPostRequest extends FormRequest
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
            'group_id' => 'required|integer|exists:groups,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'type' => ['required', 'string', Rule::in(TestType::cases())],
            'semester' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('tests', 'semester')
                    ->where('group_id', $this->group_id)
                    ->where('subject_id', $this->subject_id)
                    ->where('type', $this->type)
            ]
        ];
    }
}
