<div class="space-y-6">
    <!-- Название -->
    <div>
        <label for="title" class="block text-text-secondary mb-2">Название <span class="text-accent">*</span></label>
        <input type="text" 
               name="title" 
               id="title" 
               class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('title') border-red-500 @enderror"
               value="{{ old('title', $task->title ?? '') }}"
               placeholder="Название задачи"
               required>
        @error('title')
            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Описание -->
    <div>
        <label for="description" class="block text-text-secondary mb-2">Описание</label>
        <textarea name="description" 
                  id="description" 
                  rows="4" 
                  class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('description') border-red-500 @enderror"
                  placeholder="Описание задачи">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Статус, Приоритет, Исполнитель -->
    <div class="grid md:grid-cols-3 gap-6">
        <div>
            <label for="task_status_id" class="block text-text-secondary mb-2">Статус <span class="text-accent">*</span></label>
            <select name="task_status_id" 
                    id="task_status_id" 
                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white focus:outline-none focus:border-accent2 transition @error('task_status_id') border-red-500 @enderror"
                    required>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('task_status_id', $task->task_status_id ?? '') == $status->id ? 'selected' : '' }}>
                        {{ $status->label }}
                    </option>
                @endforeach
            </select>
            @error('task_status_id')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="task_priority_id" class="block text-text-secondary mb-2">Приоритет <span class="text-accent">*</span></label>
            <select name="task_priority_id" 
                    id="task_priority_id" 
                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white focus:outline-none focus:border-accent2 transition @error('task_priority_id') border-red-500 @enderror"
                    required>
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('task_priority_id', $task->task_priority_id ?? '') == $priority->id ? 'selected' : '' }}>
                        {{ $priority->label }}
                    </option>
                @endforeach
            </select>
            @error('task_priority_id')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="assigned_to" class="block text-text-secondary mb-2">Исполнитель</label>
            <select name="assigned_to" 
                    id="assigned_to" 
                    class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white focus:outline-none focus:border-accent2 transition @error('assigned_to') border-red-500 @enderror">
                <option value="">Не назначен</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('assigned_to')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Срок, Оценка, Сортировка -->
    <div class="grid md:grid-cols-3 gap-6">
        <div>
            <label for="due_date" class="block text-text-secondary mb-2">Срок выполнения</label>
            <input type="date" 
                   name="due_date" 
                   id="due_date" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('due_date') border-red-500 @enderror"
                   value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
            @error('due_date')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="estimated_hours" class="block text-text-secondary mb-2">Оценка (часы)</label>
            <input type="number" 
                   name="estimated_hours" 
                   id="estimated_hours" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('estimated_hours') border-red-500 @enderror"
                   value="{{ old('estimated_hours', $task->estimated_hours ?? '') }}"
                   min="0"
                   placeholder="0">
            @error('estimated_hours')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="sort" class="block text-text-secondary mb-2">Порядок сортировки</label>
            <input type="number" 
                   name="sort" 
                   id="sort" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('sort') border-red-500 @enderror"
                   value="{{ old('sort', $task->sort ?? 0) }}"
                   min="0"
                   placeholder="0">
            <div class="text-xs text-text-tertiary mt-1">Чем меньше число, тем выше в списке</div>
            @error('sort')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
