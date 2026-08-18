<div class="mb-3">
    <label for="title" class="form-label">Название <span class="text-danger">*</span></label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $project->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug (ЧПУ)</label>
    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $project->slug ?? '') }}">
    <small class="form-text text-muted">Можно оставить пустым</small>
    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Описание</label>
    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="client_name" class="form-label">Клиент</label>
        <input type="text" name="client_name" id="client_name" class="form-control @error('client_name') is-invalid @enderror"
               value="{{ old('client_name', $project->client_name ?? '') }}">
        @error('client_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="site_url" class="form-label">Сайт</label>
        <input type="url" name="site_url" id="site_url" class="form-control @error('site_url') is-invalid @enderror"
               value="{{ old('site_url', $project->site_url ?? '') }}" placeholder="https://example.com">
        @error('site_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="repository_url" class="form-label">Репозиторий</label>
        <input type="url" name="repository_url" id="repository_url" class="form-control @error('repository_url') is-invalid @enderror"
               value="{{ old('repository_url', $project->repository_url ?? '') }}" placeholder="https://github.com/...">
        @error('repository_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Статус</label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
        @foreach(\App\Models\TrackerProject::STATUSES as $key => $label)
            <option value="{{ $key }}" {{ old('status', $project->status ?? 'active') == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
