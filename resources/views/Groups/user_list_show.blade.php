@extends('layout')

@section('content')
    <div class="uper">

        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <h2>Group: {{$group->group_name}}</h2>

        <p>Users currently in group:</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Remove users from the group</td>
            </tr>
            </thead>
            <tbody>
            @foreach($enrolled_users as $en_users)
                <tr>
                    <td>{{$en_users->user->id}}</td>
                    <td>{{$en_users->user->name}}</td>
                    <td>
                        <form action="{{ route('Groups.destroy_user_entry', ['Group' => $group->id,'User' => $en_users->user->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="uper">
        <p>All available users:</p>
        <table class="table table-striped">
            <thead>
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Add users to the group</strong></td>
            </tr>
            </thead>
            <tbody>
            @foreach($available_users as $av_users)
                <tr>
                    <td>{{$av_users->id}}</td>
                    <td>{{$av_users->name}}</td>
                    <td>
                        <form action="{{ route('Groups.add_to_group_ins',['Group' => $group->id,'User' => $av_users->id])}}" method="post">
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