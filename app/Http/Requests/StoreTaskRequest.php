<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_status_id' => ['required', 'exists:task_statuses,id'],
            'task_priority_id' => ['required', 'exists:task_priorities,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'estimated_hours' => ['nullable', 'integer', 'min:0'],
            'actual_hours' => ['nullable', 'integer', 'min:0'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'sort' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'task_status_id.required' => 'Выберите статус задачи',
            'task_priority_id.required' => 'Выберите приоритет задачи',
            'title.required' => 'Название задачи обязательно',
            'due_date.date' => 'Неверный формат даты',
        ];
    }
}
