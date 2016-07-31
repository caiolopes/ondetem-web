<?php

namespace App\Http\Controllers;

use App\Confirmation;
use App\Place;
use Auth;
use \Illuminate\Http\Request;

class PlaceWebController extends Controller
{
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
        $place = Place::create($request->except('types'));
        foreach ($request->get('types') as $type) {
            $place->place_type()->sync($type);
        }
        return redirect('/home')->with('message', 'Cadastrado com sucesso');
    }

    public function getEdit($id)
    {
        $place = Place::with('place_type')->find($id);
        return view('place.add')->with(['place' => $place]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request, $this->validationRules);
        $place = Place::find($id);

        $place->update($request->except('types'));
        foreach ($request->get('types') as $type) {
            $place->place_type()->sync($type);
        }

        return redirect()->back()->with('message', 'Editado com sucesso');
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
        $this->validate($request, [
            'place' => 'bail|required|exists:places,id',
            'exists' => 'required|boolean'
        ]);

        $user = Auth::getUser();
        $place = Place::find($request->get('place'));
        $existsInDb = Confirmation::where(
            [['user_id', $user->id], ['place_id', $place->id]]
        )->first();

        $confirmation = Confirmation::where(
            [['user_id', $user->id],
            ['place_id', $place->id],
            ['exists', !$request->get('exists')]]
        )->first();

        if ($confirmation == null && $existsInDb != null) {
            $existsInDb->delete();
            return redirect()->back()->with('warning', 'Confirmação removida');
        } else if ($existsInDb != null) {
            $confirmation->delete();
        }

        $confirmation = new Confirmation([
            'user_id' => $user->id,
            'place_id' => $place->id,
            'exists' => $request->get('exists')
        ]);
        $confirmation->save();

        return redirect()->back()->with('message', 'Obrigado por contribuir!');
    }

    public function getSearch(Request $request)
    {
        if ($request->has('key')) {
            $key = $request->get('key');

            $places = Place::where('name', 'like', "%$key%")
                ->orWhere('address', 'like', "%$key%")
                ->paginate(10);

            return view('place.list')->with(['places' => $places, 'query' => $key]);
        } elseif ($request->has('type') && $request->has('category')) {
            $type = $request->get('type');
            $places = Place::with('place_type')
                ->whereHas('place_type', function ($query) use ($type) {
                    $query->where('place_types.id', '=', $type);
                })
                ->paginate(10);
            return view('place.list')->with(['places' => $places]);
        }
        return redirect('/places');
    }

    public function getDelete(Request $request, $id)
    {
        $place = Place::find($id);
        $place->delete();
        return redirect('places')->with('message', 'Deletado com sucesso');
    }
}
