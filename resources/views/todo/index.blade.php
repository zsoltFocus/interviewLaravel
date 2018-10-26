@extends('layouts.app')

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <div class="row">
        <div class="col-2">
            <a class="btn btn-primary btn-close" href="{{ route('todo.create') }}">Add New ToDo</a>
            {{--<a href="{{ route('todo.create') }}" class="btn btn-primary">Add New ToDo</a>--}}
        </div>
        <div class="col-12">&nbsp;</div>
        <div class="col-12">
            <table style="width:100%">
                <tr>
                    <th>ToDo</th>
                    <th>Actions</th>
                </tr>
                @foreach($todos as $todo)
                    <tr>
                        <td>
                            @if($todo->done == true)
                                <del>{{ $todo->todo }}</del>
                            @else
                                {{ $todo->todo }}
                            @endif
                        </td>
                        <td>
                            @if($todo->done == true)
                                <a href="{{ route('todo.undone', $todo->id) }}" class="btn btn-warning">UnDone</a>
                            @else
                                <a href="{{ route('todo.done', $todo->id) }}" class="btn btn-success">Done</a>
                            @endif
                            <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
