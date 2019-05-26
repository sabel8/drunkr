<?php

namespace App\Http\Controllers;

use App\Drink;
use Illuminate\Http\Request;
use App\DrinkType;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UnitType;
use App\Http\Requests\StoreUserDrink;
use App\Place;

class UserDrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: middleware
        if (Auth::check() == false) {
            return redirect('/login')->with('errorMessage', 'You have to be logged in to see your drinks.');
        }
        $userDrinks = User::findOrFail(Auth::id())->drinks;
        $units = UnitType::all();
        $drinkTypes = DrinkType::all();
        $places = Place::all();
        return view('user.mydrinks', compact('units', 'userDrinks', 'drinkTypes', 'places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDrink $request)
    {
        $drinkType = DrinkType::firstOrCreate(['name' => $request['drink_type']]);
        $placeID = Place::firstOrCreate(
            [
                'name' => $request['place_name'],
                'latitude' => $request['place_latitude'],
                'longitude' => $request['place_longitude'],
            ]
        );
        Drink::create([
            'name' => $request['drink_name'],
            'type_id' => $drinkType->id,
            'volume_value' => $request['volume_value'],
            'volume_unit_type_id' => $request['volume_unit'],
            'user_id' => $request->user()->id,
            'alcohol_percent' => $request['alcohol_percent'],
            'place_id' => $placeID->id,
            'price' => $request['price']
        ]);
        return redirect(route('drinks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function show(Drink $drink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function edit(Drink $drink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drink $drink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drink $drink)
    {
        $drink->delete();
        return redirect(route('drinks.index'));
    }
}
