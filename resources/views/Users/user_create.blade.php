@extends('layout')

@section('content')
    <div class="card uper">
        <div class="card-header">
            Create a user
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('User.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">User Name:</label>
                    <input type="text" class="form-control" name="user_name"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection