@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Student wants new course</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table">
                                <thead class="thead-dark">

                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Credit</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">PickUp</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{$subject->name}}</td>
                                        <td>{{$subject->desc}}</td>
                                        <td>{{$subject->code}}</td>
                                        <td>{{$subject->credit}}</td>
                                        <td>{{$subject->user->name}}</td>
                                        <td> <a href="/diak/pickup/{{$subject->id}}" class="btn btn-danger"><span class="left ion-close">Pick Up</span></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
