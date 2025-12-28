<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Add Task | Listify</title>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-box">

        <h1 class="auth-title">Add New Task</h1>
        <p class="auth-subtitle">Fill in the details below</p>

        @if($errors->any())
            <div class="alert-custom alert-danger mb-5">
                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="mb-4 position-relative">
                <input type="text" name="title" class="form-control wide-input" placeholder="Enter task title" value="{{ old('title') }}" required autofocus>
                <i class="bi bi-card-heading position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
            </div>

            <div class="mb-5 position-relative">
                <textarea name="description" class="form-control wide-textarea" rows="4" placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                <i class="bi bi-chat-dots position-absolute top-50 end-0 translate-middle-y me-4 text-secondary"></i>
            </div>

            <div class="row g-3 mb-5">
                <div class="col-6 position-relative">
                    <input type="date" name="deadline" class="form-control date-input" placeholder="dd / mm / yyyy" value="{{ old('deadline') }}">
                </div>
                <div class="col-6 position-relative">
                    <input type="time" name="deadline_time" class="form-control time-input" placeholder="-- : -- --" value="{{ old('deadline_time') }}">   
                </div>
            </div>

            <div class="d-flex justify-content-center gap-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-cancel w-100 py-3">
                    Cancel
                </a>
                <button type="submit" class="btn btn-add-task w-100 py-3">
                    Add Task
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        min-height: 100vh;
        background: radial-gradient(circle at top, #1f2430 0%, #0f1218 45%, #0b0d12 100%);
        color: #ffffff;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .auth-box {
        width: 100%;
        max-width: 560px;
        text-align: center;
        background-color: rgba(22, 26, 34, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .auth-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        font-size: 1rem;
        color: #a0a6b4;
        margin-bottom: 3rem;
    }

    .form-control {
        background-color: #161a22;
        border: 1px solid #2a2f3d;
        color: #ffffff;
        padding: 0.9rem 1rem;
        border-radius: 14px;
        font-size: 1rem;
    }

    .form-control::placeholder {
        color: #6c7280;
    }

    .form-control:focus {
        background-color: #161a22;
        border-color: #39a876;
        box-shadow: 0 0 0 4px rgba(57, 168, 118, 0.15);
    }

    .form-control:date-input {

    }


    .wide-input {
        padding-right: 3rem;
    }

    .wide-textarea {
        margin-top: 1rem;
        padding-right: 3.5rem;
        padding-bottom: 2rem;
        resize: none;
    }

    .date-input,
    .time-input {
        padding-right: 1;
        margin-top: 0.5rem;
    }

    .date-input::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
    }

    .time-input::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

     .btn-add-task {
        margin-top: 1.75rem;
        background-color: #39a876;
        color: #ffffff;
        padding: 0.65rem 2rem;
        border-radius: 8px;
    }

    .btn-cancel {
        margin-right: 1.75rem;
        background-color: #1b1f2a;
        color: #ffffff;
        padding: 0.5rem 2rem;
        border-radius: 8px;

    }
</style>

</body>
</html>