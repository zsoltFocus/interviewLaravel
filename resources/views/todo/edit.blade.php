@extends('layouts.app')

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New ToDo</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('todo.update', $todo->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group row">
                                <label for="todo" class="col-sm-4 col-form-label text-md-right">ToDo:</label>

                                <div class="col-md-6">
                                    <input id="todo" type="text" class="form-control{{ $errors->has('todo') ? ' is-invalid' : '' }}" name="todo" value="{{ old('todo', $todo->todo) }}" required autofocus>

                                    @if ($errors->has('todo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('todo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                    <a class="btn btn-warning btn-close" href="{{ route('todo.index') }}">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
