@extends('layout')

@section('content')

    <div class="uper">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <h2>User: {{$user->name}}</h2>

        <p>Groups that user is in:</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Remove user from group/-s</td>
            </tr>
            </thead>
            <tbody>
            @foreach($enrolled_groups as $en_group)
                <tr>
                    <td>{{$en_group->group->id}}</td>
                    <td>{{$en_group->group->group_name}}</td>
                    <td>
                        <form action="{{ route('User.destroy_group_entry', ['Group' => $en_group->group->id,'User' => $user->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>All available groups:</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Add user to group/-s</td>
            </tr>
            </thead>
            <tbody>
            @foreach($available_groups as $group)
                <tr>
                    <td>{{$group->id}}</td>
                    <td>{{$group->group_name}}</td>
                    <td>
                        <form action="{{ route('User.add_to_group_ins',['Group' => $group->id,'User' => $user->id])}}" method="post">
                            @csrf
                            <button class="btn btn-primary" type="submit">Add</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection