@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

  <div class="card uper">

  <div class="card-header">
    <a class="btn btn-primary" href="{{ route('posts.create') }}"> Create New Entry</a>
  </div>
 
  <div class="card-body">
    @if(session()->get('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    <div class="alert alert-success">
      {{ session()->get('success') }}  
</div>
    </div><br />
  @endif
     <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Post name</td>
          <td>Post address</td>
          <td colspan="3">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->name}}</td>
            <td>{{$post->address}}</td>
            <td><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a class="btn btn-primary" href="{{ route('posts.show',$post->id) }}">Show</a></td>
            <td>
                <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit"onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  </div>
</div>
  
@endsection