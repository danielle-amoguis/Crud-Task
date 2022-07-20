@extends('layouts.app', ['activePage' => 'tasks', 'titlePage' => __('CRUD Task')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="row">
            <div class="col-12 text-left">
                <a href="{{ route('tasks.create')}}" class="btn btn-info">Create Post</a>
            </div>
          </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">CRUD Table</h4>
            <p class="card-category"> CRUD Table Dashboard Material</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>ID</th>
                  <th>Task</th>
                  <th>Description</th>
                  <th>Timestamp</th>
                  <th>Action</th> 
                </thead>
                <tbody>
                 @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->id}}</td>
                    <td>{{$task->task}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->created_at}}</td>
                    <td>
                      <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                    </td>
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection