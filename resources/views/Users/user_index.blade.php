@extends('layout')

@section('content')

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <a href="{{ route('User.create')}}" class="btn btn-primary custom-btn"> Create a new user</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Check user groups</td>
                <td>Delete user</td>
            </tr>
            </thead>
            <tbody>
            @foreach($Users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td><a href="{{ route('User.add_to_group',$user->id)}}" class="btn btn-primary">Groups</a></td>
                    <td>
                        <form action="{{ route('User.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection