<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log as Log;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = DB::connection('mysql_poi')->select('select * from PlaceDetails GROUP BY place_id');
        foreach($places as $place) {
            DB::table('places')->insert([
                'id' => $place->place_id,
                'name' => $place->name,
                'address' => $place->formatted_address,
                'phone' => $place->formatted_phone_number,
                'latitude' => $place->latitude,
                'longitude' => $place->longitude,
                'icon' => $place->icon,
                'url' => $place->url,
                'website' => $place->website,
                'active' => true,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        $types = DB::connection('mysql_poi')->select('select * from RelateDetailsTypes');
        foreach($types as $type) {
              DB::table('place_place_type')->insert([
                'id' => $type->relate_id,
                'place_id' => $type->place_id,
                'place_type_id' => $type->type_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
