@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Create Post
  </div>
  <div class="card-body">
    @if ($errors->any())
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>
      </div><br />
    @endif
      <form method="post" action="{{ route('posts.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" id="name" />
          </div>
          <div class="form-group">
              <label for="price">Address</label>
              <textarea name="address" id="address" class="form-control"></textarea>
              
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection