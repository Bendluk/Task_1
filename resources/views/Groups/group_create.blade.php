@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 20px;
        }
    </style>
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
            <form method="post" action="{{ route('Groups.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Group Name:</label>
                    <input type="text" class="form-control" name="group_name"/>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection