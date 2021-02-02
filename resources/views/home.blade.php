@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
                <h2>Students</h2>
                @foreach($students as $student)
                    <li>{{$student->name}}</li>
                @endforeach
                <h2>Teachers</h2>
                @foreach($teachers as $teacher)
                    <li>{{$teacher->name}}</li>
                @endforeach

                <h2>Tasks counter:</h2>
                <h2>Solutions counter:</h2>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
