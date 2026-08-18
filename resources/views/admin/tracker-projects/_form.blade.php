<div class="space-y-6">
    <!-- Название -->
    <div>
        <label for="title" class="block text-text-secondary mb-2">Название <span class="text-accent">*</span></label>
        <input type="text" 
               name="title" 
               id="title" 
               class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('title') border-red-500 @enderror"
               value="{{ old('title', $project->title ?? '') }}"
               placeholder="Название проекта"
               required>
        @error('title')
            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Slug -->
    <div>
        <label for="slug" class="block text-text-secondary mb-2">Slug (ЧПУ)</label>
        <input type="text" 
               name="slug" 
               id="slug" 
               class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('slug') border-red-500 @enderror"
               value="{{ old('slug', $project->slug ?? '') }}"
               placeholder="можно оставить пустым">
        <div class="text-xs text-text-tertiary mt-1">Можно оставить пустым</div>
        @error('slug')
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
                  placeholder="Описание проекта">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Клиент, Сайт, Репозиторий -->
    <div class="grid md:grid-cols-3 gap-6">
        <div>
            <label for="client_name" class="block text-text-secondary mb-2">Клиент</label>
            <input type="text" 
                   name="client_name" 
                   id="client_name" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('client_name') border-red-500 @enderror"
                   value="{{ old('client_name', $project->client_name ?? '') }}"
                   placeholder="Имя клиента">
            @error('client_name')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="site_url" class="block text-text-secondary mb-2">Сайт</label>
            <input type="url" 
                   name="site_url" 
                   id="site_url" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('site_url') border-red-500 @enderror"
                   value="{{ old('site_url', $project->site_url ?? '') }}"
                   placeholder="https://example.com">
            @error('site_url')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="repository_url" class="block text-text-secondary mb-2">Репозиторий</label>
            <input type="url" 
                   name="repository_url" 
                   id="repository_url" 
                   class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white placeholder:text-text-tertiary focus:outline-none focus:border-accent2 transition @error('repository_url') border-red-500 @enderror"
                   value="{{ old('repository_url', $project->repository_url ?? '') }}"
                   placeholder="https://github.com/...">
            @error('repository_url')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Статус -->
    <div>
        <label for="status" class="block text-text-secondary mb-2">Статус <span class="text-accent">*</span></label>
        <select name="status" 
                id="status" 
                class="w-full px-4 py-3 bg-background border border-white/10 rounded-xl text-white focus:outline-none focus:border-accent2 transition @error('status') border-red-500 @enderror">
            @foreach(\App\Models\TrackerProject::STATUSES as $key => $label)
                <option value="{{ $key }}" {{ old('status', $project->status ?? 'active') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
