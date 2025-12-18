<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2>Edit Task</h2>

        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                @error('title')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}">
                @error('deadline')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Time</label>
                <input type="time" name="deadline_time" class="form-control" value="{{ old('deadline_time', $task->deadline_time ? \Carbon\Carbon::parse($task->deadline_time)->format('H:i') : '') }}">
                @error('deadline_time')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_completed" value="1" {{ $task->is_completed ? 'checked' : '' }}>
                <label class="form-check-label">Completed</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
</x-app-layout>
