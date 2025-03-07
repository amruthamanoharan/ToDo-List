@extends("layouts.default")

@section("content")
<div class="container" style="position: relative; max-width: 500px; margin-top: 100px;">
    <a href="{{ route('home') }}" class="btn btn-outline-success text-right add-task-btn">List Tasks</a>
        <div class="container card shadow-sm" style="max-width : 500px; margin-top : 10px">
            <div class="fs-3 fw-bold text-center mt-3">Add New Task</div>
            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
            @if(session("error"))
                <div class="alert alert-danger">
                    {{session("error")}}
                </div>
            @endif
            <form class="p-3" method="POST" action="{{route('task.add.post')}}">
                @csrf
                <div class="mb-3">
                    <input name="title" type="text" class="form-control" placeholder="Title">
                    @error('title')
                        <span class="text-danger">{{ $message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" rows="3" placeholder="Description"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="datetime-local" name="deadline" class="form-control">
                    @error('deadline')
                        <span class="text-danger">{{ $message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success rounded-pill">Submit</button>
            </form>
        </div>
    </div>
@endsection