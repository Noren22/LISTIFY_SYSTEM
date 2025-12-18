<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-2xl font-semibold">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-success">Add Task</a>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($tasks->isEmpty())
            <div class="alert alert-info">No tasks found. Add your first task!</div>
        @else
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        @php
                            $isOverdue = false;
                            if ($task->deadline) {
                                try {
                                    $timePart = $task->deadline_time ? \Carbon\Carbon::parse($task->deadline_time)->format('H:i:s') : '00:00:00';
                                    $due = \Carbon\Carbon::parse($task->deadline->format('Y-m-d') . ' ' . $timePart);
                                    $isOverdue = $due->isPast() && ! $task->is_completed;
                                } catch (Exception $e) {
                                    $isOverdue = $task->deadline->isPast() && ! $task->is_completed;
                                }
                            }
                        @endphp
                        <tr class="@if($task->is_completed) table-success @elseif($isOverdue) table-danger @else table-warning @endif">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if($task->deadline)
                                    {{ $task->deadline->format('M d, Y') }}
                                    @if($task->deadline_time)
                                        · {{ \Carbon\Carbon::parse($task->deadline_time)->format('g:i A') }}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($task->is_completed)
                                    <span class="badge bg-success">Completed</span>
                                @elseif($isOverdue)
                                    <span class="badge bg-danger">Overdue</span>
                                @else
                                    <span class="badge bg-warning text-dark">In Progress</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <!-- Toggle Completed -->
                                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        @if($task->is_completed) Mark In Progress @else Mark Completed @endif
                                    </button>
                                </form>

                                <!-- Edit -->
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
