<div class="mb-3">
    <label for="title" class="form-label">Название <span class="text-danger">*</span></label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $task->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="task_status_id" class="form-label">Статус <span class="text-danger">*</span></label>
        <select name="task_status_id" id="task_status_id" class="form-control @error('task_status_id') is-invalid @enderror" required>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ old('task_status_id', $task->task_status_id ?? '') == $status->id ? 'selected' : '' }}>
                    {{ $status->label }}
                </option>
            @endforeach
        </select>
        @error('task_status_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="task_priority_id" class="form-label">Приоритет <span class="text-danger">*</span></label>
        <select name="task_priority_id" id="task_priority_id" class="form-control @error('task_priority_id') is-invalid @enderror" required>
            @foreach($priorities as $priority)
                <option value="{{ $priority->id }}" {{ old('task_priority_id', $task->task_priority_id ?? '') == $priority->id ? 'selected' : '' }}>
                    {{ $priority->label }}
                </option>
            @endforeach
        </select>
        @error('task_priority_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="assigned_to" class="form-label">Исполнитель</label>
        <select name="assigned_to" id="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
            <option value="">Не назначен</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to ?? '') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('assigned_to') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="due_date" class="form-label">Срок выполнения</label>
        <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror"
               value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
        @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="estimated_hours" class="form-label">Оценка (часы)</label>
        <input type="number" name="estimated_hours" id="estimated_hours" class="form-control @error('estimated_hours') is-invalid @enderror"
               value="{{ old('estimated_hours', $task->estimated_hours ?? '') }}" min="0">
        @error('estimated_hours') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="sort" class="form-label">Порядок сортировки</label>
        <input type="number" name="sort" id="sort" class="form-control @error('sort') is-invalid @enderror"
               value="{{ old('sort', $task->sort ?? 0) }}" min="0">
        <small class="form-text text-muted">Чем меньше число, тем выше в списке</small>
        @error('sort') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
