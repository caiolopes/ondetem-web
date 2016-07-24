<?php

namespace App\Http\Controllers;

use App\Confirmation;
use App\Place;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Log;
use Validator, JWTAuth;

class PlaceController extends Controller {
    private $validationRules = [
        'name' => 'required',
        'types' => 'required|array',
        'types.*.id' => 'required|numeric|exists:place_types,id',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric'
    ];


    // Web Routes
    public function addNewPlaceForm()
    {
        return view('place.add');
    }

    public function addNewPlace(Request $request)
    {
        $this->validate($request, $this->validationRules);

        $this->store($request);

        return redirect('/home');
    }

    // API REST Routes

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails())
            return response()->json(['error' => ['message' => $validator->messages()]],
                Response::HTTP_BAD_REQUEST,
                $headers = []);

        return response()->json($this->store($request), Response::HTTP_CREATED);
    }

    private function store(Request $request)
    {
        $place = Place::create($request->except('types'));

        foreach($request->only('types')['types'] as $type) {
            if (isset($type['id'])) {
                $place->place_type()->attach($type);
            }
        }

        return $place = Place::with(['place_type', 'confirmations'])->get()->find($place->id);
    }

    public function delete($id)
    {
        // check if it is admin to delete
        $user = JWTAuth::parseToken()->toUser();
        if ($user->is_admin) {
            $elem = Place::find($id);
            if ($elem != null) {
                $elem->delete();
                return response()->json([], Response::HTTP_NO_CONTENT);
            } else {
                return response()->json([], Response::HTTP_BAD_REQUEST);
            }
        }
        return response()->json([], Response::HTTP_UNAUTHORIZED);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'message' => $validator->messages()
                ]],
                Response::HTTP_BAD_REQUEST,
                $headers = []
            );
        }

        $elem = Place::find($id);

        $elem->update($request->all());

        return response()->json($elem, Response::HTTP_OK);
    }

    public function confirm($id, Request $request)
    {
        $place = Place::find($id);
        $user_id = JWTAuth::parseToken()->toUser()->id;

        $validator = Validator::make([
            'user_id' => $user_id,
            'place_id' => $id,
            'exists' => $request->only('exists')['exists']
        ], [
            'user_id' => 'required|unique_with:confirmations,place_id',
            'place_id' => 'required',
            'exists' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'message' => $validator->messages()
                ]],
                Response::HTTP_BAD_REQUEST,
                $headers = []
            );
        }
        $confirmation = new Confirmation(['user_id' => $user_id, 'exists' => $request->only('exists')['exists']]);
        $place->confirmations()->save($confirmation);

        return response()->json($confirmation, Response::HTTP_OK);
    }

    public function all(Request $request)
    {
        $per_page = $request->input('per');
        $form = $request->input('form');
        if ($form != null)
            if ($form == "true") {
                return Place::all();
            }

        if ($per_page == null || !(is_numeric($per_page)))
            $per_page = 10;
        else
            $per_page = (int)$per_page;

        return Place::with('place_type', 'confirmations')->paginate($per_page);
    }

    public function get($id)
    {
        $elem = Place::find($id);
        if ($elem != null)
            return response()->json($elem, Response::HTTP_OK);
        else
            return response()->json([], Response::HTTP_NO_CONTENT);
    }
}