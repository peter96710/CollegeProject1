@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$subjects->name }} datas:</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{$subjects->name}}<br>
                        {{$subjects->desc}}<br>
                        {{$subjects->code}}<br>
                        {{$subjects->credit}}<br>
                        {{$subjects->created_at}}<br>
                        {{$subjects->updated_at}}<br>

                        @if($subjects->published)
                            <a href="/tanar/unpublish/{{$subjects->id}}" class="btn btn-danger"><span
                                    class="left ion-close">Unpublish</span></a>
                        @else
                            <a href="/tanar/publish/{{$subjects->id}}" class="btn btn-danger"><span
                                    class="left ion-close">Publish</span></a>
                        @endif
                        <a href="/tanar/destroy/{{$subjects->id}}" class="btn btn-danger"><span
                                class="left ion-close">Delete</span></a>
                        <a href="/tanar/update/{{$subjects->id}}" class="btn btn-danger"><span
                                class="left ion-close">Update</span></a>
                            <br>
                            How many students picked up this course: {{count($students)}}
                            @foreach($students as $student)
                                <li>{{$student->name}}
                                    {{$student->email}}</li>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
