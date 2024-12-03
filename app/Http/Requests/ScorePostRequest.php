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
            'test_id' => 'required|integer|exists:tests,id',
            'mark' => [
                'required',
                'string',
                Rule::in(ScoreEnum::cases()),
                Rule::unique('scores', 'mark')
                    ->where('student_id', $this->student_id)
                    ->where('test_id', $this->test_id)
            ]
        ];
    }
}
