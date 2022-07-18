@extends('layouts.app', ['activePage' => 'posts', 'titlePage' => __('Edit Task')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('posts.update', $post) }}" autocomplete="off" class="form-horizontal">
            @csrf 
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Task') }}</h4>
                <p class="card-category">{{ __('Input Changes') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Task') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Task') }}" value="{{ old('name', $post->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" id="input-address" type="address" placeholder="{{ __('Description') }}" value="{{ old('address', $post->address) }}" required />
                      @if ($errors->has('address'))
                        <span id="address-error" class="error text-danger" for="input-address">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
        </div>
      </div>
@endsection