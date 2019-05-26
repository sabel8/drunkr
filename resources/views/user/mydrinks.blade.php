@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="card" style="margin-bottom:20px">
            <div class="card-header"><h2>My drinks</h2></div>
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Volume</th>
                                <th>Price</th>
                                <th>DrunkR factor</th>
                                <th>Place</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userDrinks as $drink)
                                <tr>
                                    <td>{{$drink->name . " " . $drink->type->name}}</td>
                                    <td>{{$drink->volume_value . " " . $drink->unitType->name}}</td>
                                    <td>{{$drink->price . " Ft"}}</td>
                                    <td>{{ round($drink->drunkRFactor(),2) }}</td>
                                    <td>{!! $drink->place==null?"<i>No place given</i>":
                                        "<a href='".route('map',['place' => $drink->place->id])."'>"
                                        . htmlspecialchars($drink->place->name) ."</a>" !!}</td>
                                    <td>
                                        
                                        {{-- <form style="display:inline-block;margin-right: 5px" href="{{route('drinks.edit', ['drink' => $drink->id])}}">
                                            @csrf
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="material-icons btn btn-primary">edit</button>
                                            </div>
                                        </form> --}}

                                        <form style="display:inline-block" href="{{route('drinks.destroy', ['drink' => $drink->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group">
                                                <button type="submit" name="submit" class="material-icons btn btn-danger">delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
        </div>
        @include('layouts.advancedDrunkRForm')
	</div>
@endsection