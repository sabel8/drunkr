@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:20px">
        @auth
            <h2>Welcome {{ Auth::user()->name}}!</h2>
        @else
            <h2>Welcome Guest!</h2>
        @endauth
        <div class="card" style="margin-top: 20px">
            <div class="card-header"><h3>List of alcohols</h3></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Volume</th>
                            <th>Price</th>
                            <th>DrunkR factor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drinks as $drink)
                            <tr>
                                <td>{{$drink->name . " " . $drink->type->name}}</td>
                                <td>{{$drink->volume_value . " " . $drink->unitType->name}}</td>
                                <td>{{$drink->price . " Ft"}}</td>
                                <td>{{ round($drink->drunkRFactor(),2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="margin-top:20px;margin-bottom:20px">
            <div class="col-lg-8">
                @include('layouts.drunkrform')
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">What is the DrunkR factor?</div>
                    <div class="card-body">Basically it is lorem ipsum.</div>
                </div>
            </div>
        </div>
    </div>
@endsection
