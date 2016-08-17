<?php

namespace App\Http\Controllers;

use App\Confirmation;
use App\Place;
use \Illuminate\Http\Request;
use Log, DB, Auth;

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
        $types = [];
        foreach ($request->get('types') as $type) {
            $types[] = intval($type['id']);
        }
        $place->place_type()->sync($types);        return redirect('/home')->with('message', 'Cadastrado com sucesso');
    }

    public function getEdit($id)
    {
        $place = Place::with('place_type')->find($id);
        return view('place.add')->with('place', $place);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request, $this->validationRules);
        $place = Place::find($id);

        $place->update($request->except('types'));
        $types = [];
        foreach ($request->get('types') as $type) {
            $types[] = intval($type['id']);
        }
        $place->place_type()->sync($types);

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
        $place = Place::with('place_type')->find($request->get('place'));
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

        $confirmations = Confirmation::where([['place_id', '=' ,$place->id], ['exists', '=', true]])->count();
        if ($confirmations >= 2 && !$place->active) {
            DB::connection('mysql_poi')
                ->table('PlaceDetails')
                ->insert([
                    'place_id' => $place->id,
                    'name' => $place->name,
                    'formatted_address' => $place->address,
                    'formatted_phone_number' => $place->phone,
                    'latitude' => $place->latitude,
                    'longitude' => $place->longitude,
                    'icon' => $place->icon,
                    'url' => $place->url,
                    'website' => $place->website,
                ]);

            foreach($place->place_type as $type) {
                  DB::connection('mysql_poi')->table('RelateDetailsTypes')->insert([
                    'place_id' => $type->place_id,
                    'type_id' => $type->place_type_id
                ]);
            }
            $place->active = true;
            $place->save();
        }

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
        } else if($request->has('active')) {
            $active = $request->get('active') == 'true' ? true : false;
            if (is_bool($active)) {
                $places = Place::where('active', $active)
                    ->paginate(10);
                return view('place.list')->with('places', $places);
            }
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
