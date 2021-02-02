@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    Email:  {{ Auth::user()->email}}<br>
                    Name:   {{ Auth::user()->name}}<br>
                    Role:   @if( Auth::user()->roles->first()->name == "tanar") Tanár @endif
                            @if( Auth::user()->roles->first()->name == "diak") Diák @endif<br>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
