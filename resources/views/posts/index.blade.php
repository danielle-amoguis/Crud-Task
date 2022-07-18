@extends('layouts.app', ['activePage' => 'posts', 'titlePage' => __('CRUD Posts')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="row">
            <div class="col-12 text-left">
                <a href="{{ route('posts.create')}}" class="btn btn-info">Create Post</a>
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
                 @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->name}}</td>
                    <td>{{$post->address}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                      <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
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