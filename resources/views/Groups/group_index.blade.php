@extends('layout')

@section('content')

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div><br />
            @endif

        <a href="{{ route('Groups.create')}}" class="btn btn-primary custom-btn"> Create a new group</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Check group user list/-s</td>
                <td>Delete the group</td>
            </tr>
            </thead>
            <tbody>
            @foreach($Groups as $group)
                <tr>
                    <td>{{$group->id}}</td>
                    <td>{{$group->group_name}}</td>
                    <td><a href="{{ route('Groups.add_to_group',$group->id)}}" class="btn btn-primary">List</a></td>
                    <td>
                        <form action="{{ route('Groups.destroy', $group->id)}}" method="post">
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