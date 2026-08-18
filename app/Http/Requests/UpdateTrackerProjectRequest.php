<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTrackerProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $trackerProject = $this->route('tracker_project');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('tracker_projects', 'slug')
                    ->ignore($trackerProject?->id),
            ],
            'description' => ['nullable', 'string'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'site_url' => ['nullable', 'url', 'max:255'],
            'repository_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'string', 'in:active,paused,completed,archived'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название проекта обязательно',
            'slug.unique' => 'Такой slug уже используется',
            'status.in' => 'Некорректный статус',
        ];
    }
}
