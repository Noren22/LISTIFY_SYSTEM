<x-app-layout>
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold text-light">My Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-teal">
                + Add Task
            </a>
        </div>


        @if(session('success'))
            <div class="alert alert-teal">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->isEmpty())
            <div class="alert alert-dark-info">
                No tasks found. Add your first task!
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-dark-custom align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            @php
                                $isOverdue = false;
                                if ($task->deadline) {
                                    try {
                                        $timePart = $task->deadline_time
                                            ? \Carbon\Carbon::parse($task->deadline_time)->format('H:i:s')
                                            : '00:00:00';

                                        $due = \Carbon\Carbon::parse(
                                            $task->deadline->format('Y-m-d') . ' ' . $timePart
                                        );

                                        $isOverdue = $due->isPast() && ! $task->is_completed;
                                    } catch (Exception $e) {
                                        $isOverdue = $task->deadline->isPast() && ! $task->is_completed;
                                    }
                                }
                            @endphp

                            <tr class="
                                @if($task->is_completed) row-complete
                                @elseif($isOverdue) row-overdue
                                @else row-progress
                                @endif
                            ">
                                <td>{{ $task->title }}</td>
                                <td class="text-muted">{{ $task->description }}</td>
                                <td>
                                    @if($task->deadline)
                                        {{ $task->deadline->format('M d, Y') }}
                                        @if($task->deadline_time)
                                            · {{ \Carbon\Carbon::parse($task->deadline_time)->format('g:i A') }}
                                        @endif
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if($task->is_completed)
                                        <span class="badge badge-teal">Completed</span>
                                    @elseif($isOverdue)
                                        <span class="badge badge-red">Overdue</span>
                                    @else
                                        <span class="badge badge-yellow">In Progress</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    
                                        <form method="POST" action="{{ route('tasks.toggle', $task->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-teal">
                                                @if($task->is_completed)
                                                    Mark In Progress
                                                @else
                                                    Mark Completed
                                                @endif
                                            </button>
                                        </form>

                                        
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-yellow">
                                            Edit
                                        </a>

                                    
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                                                onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="button"
                                                class="btn btn-sm btn-outline-red"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteTaskModal"
                                                data-task-id="{{ $task->id }}"
                                                data-task-title="{{ $task->title }}"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                        <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content delete-modal">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger">Delete Task</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p class="mb-2 text-light">
                                                            Are you sure you want to delete this task?
                                                        </p>
                                                        <p class="fw-semibold text-warning" id="deleteTaskTitle"></p>
                                                        <p class="text-muted small">
                                                            This action cannot be undone.
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Cancel
                                                        </button>

                                                        <form method="POST" id="deleteTaskForm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Yes, Delete
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        /* Alerts */
        .alert-teal {
            background-color: #1f3a33;
            color: #7de2c3;
            border: 1px solid #2f8f63;
        }

        .alert-dark-info {
            background-color: #1b1f2a;
            color: #d1d5db;
            border: 1px solid #2a2f3d;
        }

        .table-dark-custom {
            width: 100%;
            background-color: transparent;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-dark-custom thead {
            background-color: transparent;
        }

        .table-dark-custom th {
            background-color: transparent;
            color: #ffffff;
            font-weight: 500;
            border-bottom: 1px solid #2a2f3d;
        }

        .table-dark-custom td {
            background-color: transparent;
            color: #c9c9c9;
            border-top: 1px solid #2a2f3d;
        }

        .table-dark-custom .text-muted {
            color: #c9c9c9 !important;
        }

        .row-complete {
            background-color: rgba(57, 168, 118, 0.08);
        }

        .row-overdue {
            background-color: rgba(220, 53, 69, 0.08);
        }

        .row-progress {
            background-color: rgba(255, 193, 7, 0.06);
        }

    
        .btn-teal {
            background-color: #39a876;
            color: #ffffff;
            border-radius: 8px;
        }

        .btn-teal:hover {
            background-color: #2f8f63;
            color: #ffffff;
        }

        .btn-outline-teal {
            color: #39a876;
            border: 1px solid #39a876;
        }

        .btn-outline-teal:hover {
            background-color: #39a876;
            color: #ffffff;
        }

        .btn-outline-yellow {
            color: #facc15;
            border: 1px solid #facc15;
        }

        .btn-outline-yellow:hover {
            background-color: #facc15;
            color: #000;
        }

        .btn-outline-red {
            color: #ef4444;
            border: 1px solid #ef4444;
        }

        .btn-outline-red:hover {
            background-color: #ef4444;
            color: #ffffff;
        }

        .badge-teal {
            background-color: #39a876;
        }

        .badge-red {
            background-color: #ef4444;
        }

        .badge-yellow {
            background-color: #facc15;
            color: #000;
        }

        .delete-modal {
            background-color: #1b1f2a;
            color: #e5e7eb;
            border-radius: 12px;
            border: 1px solid #1f2937;
        }

        .delete-modal .modal-header {
            border-bottom: 1px solid #1f2937;
        }

        .delete-modal .modal-footer {
            border-top: 1px solid #1f2937;
        }

        .delete-modal .btn-close {
            filter: invert(1);
        }

        .delete-modal .btn-danger {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .delete-modal .btn-danger:hover {
            background-color: #dc2626;
        }

       

    </style>

    <script>
    const deleteModal = document.getElementById('deleteTaskModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const taskId = button.getAttribute('data-task-id');
        const taskTitle = button.getAttribute('data-task-title');

        const form = document.getElementById('deleteTaskForm');
        form.action = `/tasks/${taskId}`;

        document.getElementById('deleteTaskTitle').textContent = taskTitle;
    });
</script>

</x-app-layout>
