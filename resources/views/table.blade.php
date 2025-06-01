@extends('layout.template')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Descripton</th>
                <th>image</th>
                <th>Created at</th>
                <th>Update at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($points as $p)
                <tr>
                    <td>{{$p->id }}</td>
                    <td>{{$p->name }}</td>
                    <td>{{$p->description}}</td>
                    <td>
                        <img src="{{ asset('storage/images/'.$p->image)}}" alt=""
                        width="200" title="{{$p->image}}">
                    </td>
                    <td>{{$p->created_at}}</td>
                    <td>{{$p->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
