<?php

namespace App\Http\Controllers;

use App\Confirmation;
use App\Place;
use \Illuminate\Http\Request;
use Log;
use Validator;

class PlaceWebController extends Controller {
    private $validationRules = [
        'name' => 'required',
        'types' => 'required|array',
        'types.*.id' => 'required|numeric|exists:place_types,id',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
    ];

    public function getAdd()
    {
        return view('place.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, $this->validationRules);

        $this->store($request);
        return redirect('/home')->with('message', 'Cadastrado com sucesso');
    }

    public function getPlaces()
    {
        $places = Place::paginate(10);
        return view('place.list')->with('places', $places);
    }

    public function getPlace($id)
    {
        $place = Place::with('place_type', 'confirmations')->find($id);
        $positive = Confirmation::where([['place_id', $id], ['exists', true]])->count();
        $negative = Confirmation::where([['place_id', $id], ['exists', false]])->count();
        $confirmations = $positive - $negative;
        return view('place.place')->with(['place' => $place, 'confirmations' => $confirmations]);
    }

    public function getConfirm(Request $request)
    {
        Log::info($request);
        $this->validate($request, [
            'place' => 'bail|required|exists:places,id',
            'exists' => 'required|boolean'
        ]);

        return redirect('/home');
    }

    public function getIndex(Request $request)
    {
        if ($request->has('key')) {
            $key = $request->get('key');

            $places = Place::where('name', 'like', "%$key%")
                ->orWhere('address', 'like', "%$key%")
                ->paginate(10);

            return view('place.list')->with(['places' => $places, 'query' => $key]);
        } else if($request->has('type') && $request->has('category')) {
            $type = $request->get('type');
            $places = Place::with('place_type')
                ->whereHas('place_type', function($query) use ($type) {
                    $query->where('place_types.id', '=', $type);
                })
                ->paginate(10);
            return view('place.list')->with(['places' => $places]);
        }
        return redirect('/places');
    }

    public function deletePlace()
    {
        return redirect('/home');
    }
}