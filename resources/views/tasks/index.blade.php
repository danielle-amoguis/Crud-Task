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
                <tbody id="task-body">
                 @foreach ($tasks as $task)
                <tr id="task-row-{{ $task->id }}">
                    <td class="task-id">{{$task->id}}</td>
                    <td class="task-task">{{$task->task}}</td>
                    <td class="task-description">{{$task->description}}</td>
                    <td class="task-updated-at">{{$task->updated_at}}</td>
                    <td>
                      <form action="{{ route('tasks.destroy', $task->id) }}" method="post">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                      </form>
                    </td>
                </tr>
                 @endforeach
                </tbody>
                <tbody class="task-row-template d-none">
                 <tr id="task-row">
                     <td class="task-id"></td>
                     <td class="task-task"></td>
                     <td class="task-description"></td>
                     <td class="task-updated-at"></td>
                     <td>
                       <form class="task-delete-form" action="" method="post">
                         <a href="#" class="btn btn-warning task-edit-link">Edit</a>
                         @csrf
                         @method('DELETE')
                         <button class="btn btn-danger" type="submit" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                       </form>
                     </td>
                 </tr>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

        

$(function(){
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;
        
  var pusher = new Pusher('8c2c7d68fad0dc3e7e41', {
    cluster: 'ap1'
  });
  
  var channel = pusher.subscribe('my-channel');

  channel.bind('task-created', function(data) {
    const rowTemplate = $($('.task-row-template').html());

    rowTemplate.attr('id', `task-row-${data.task.id}`);
    rowTemplate.find('.task-id').text(data.task.id);
    rowTemplate.find('.task-task').text(data.task.task);
    rowTemplate.find('.task-description').text(data.task.description);
    rowTemplate.find('.task-updated-at').text(data.task.updated_at);
    rowTemplate.find('.task-delete-form').attr('action',`/tasks/${data.task.id}`);
    rowTemplate.find('.task-edit-link').attr('href',`/tasks/${data.task.id}/edit`);
    
    $('#task-body').append(rowTemplate);

    console.log(data);
    alert("Task Successfully Created!");
  });
  channel.bind('task-updated', function(data) {
    $(`#task-row-${data.task.id}`).find('.task-task').text(data.task.task);
    $(`#task-row-${data.task.id}`).find('.task-description').text(data.task.description);
    $(`#task-row-${data.task.id}`).find('.task-updated-at').text(data.task.updated_at);
    console.log(data);
    alert("Task Successfully Updated!");
  });
  channel.bind('task-deleted', function(data) {
    $(`#task-row-${data.id}`).remove();
    console.log(data);
    alert("Task Successfully Deleted!");
  });

});
</script>      