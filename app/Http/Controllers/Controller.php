<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\AjaxRequest;
use App\Place;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function drinksOfPlaceAjax(AjaxRequest $request)
    {
        $drinksWithDetails = array();
        $currentPlace = Place::findOrFail((int) $request['id']);
        $drinksWithIDs = $currentPlace->drinks()->get();
        foreach ($drinksWithIDs as $curDrink) {
            $drinksWithDetails[] = [
                'name' => htmlspecialchars($curDrink->name),
                'typeName' => htmlspecialchars($curDrink->type->name),
                'drunkRFactor' => $curDrink->drunkRFactor()
            ];
        }
        $drinksWithDetails = json_encode($drinksWithDetails);
        return response()->json($drinksWithDetails);
    }
}
