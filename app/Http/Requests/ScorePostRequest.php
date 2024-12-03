<?php

namespace App\Http\Requests;

use App\Enums\ScoreEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScorePostRequest extends FormRequest
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
            'student_id' => 'required|integer|exists:students,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'test_id' => [
                'required',
                'integer',
                'exists:tests,id',
                Rule::unique('scores', 'test_id')
                    ->where('student_id', $this->student_id)
                    ->where('teacher_id', $this->teacher_id)
            ],
            'mark' => ['required', 'string', Rule::in(ScoreEnum::cases()),]
        ];
    }
}
