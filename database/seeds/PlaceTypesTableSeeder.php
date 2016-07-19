<?php

use Illuminate\Database\Seeder;

class PlaceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('place_types')->insert([
            'type'		=>	'accounting',
            'category' 	=> 	'administrative_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'airport',
            'category' 	=> 	'public_transport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'amusement_park',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'aquarium',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'art_gallery',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'atm',
            'category' 	=> 	'bank',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bakery',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bank',
            'category' 	=> 	'bank',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bar',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'beauty_salon',
            'category' 	=> 	'beauty_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bicycle_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'book_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bowling_alley',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'bus_station',
            'category' 	=> 	'public_transport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'cafe',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'campground',
            'category' 	=> 	'lodging',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'car_dealer',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'car_rental',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'car_repair',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'car_wash',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'casino',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'cemetery',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'church',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'city_hall',
            'category' 	=> 	'government',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'clothing_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'convenience_store',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'courthouse',
            'category' 	=> 	'government',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'dentist',
            'category' 	=> 	'medical_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'department_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'doctor',
            'category' 	=> 	'medical_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'electrician',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'electronics_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'embassy',
            'category' 	=> 	'government',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'establishment',
            'category' 	=> 	'notary_courier',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'finance',
            'category' 	=> 	'administrative_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'fire_station',
            'category' 	=> 	'emergency_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'florist',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'food',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'funeral_home',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'furniture_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'gas_station',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'general_contractor',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'grocery_or_supermarket',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'gym',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'hair_care',
            'category' 	=> 	'beauty_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'hardware_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'health',
            'category' 	=> 	'medical_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'hindu_temple',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'home_goods_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'hospital',
            'category' 	=> 	'emergency_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'insurance_agency',
            'category' 	=> 	'administrative_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'jewelry_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'laundry',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'lawyer',
            'category' 	=> 	'administrative_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'library',
            'category' 	=> 	'public_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'liquor_store',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'local_government_office',
            'category' 	=> 	'government',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'locksmith',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'lodging',
            'category' 	=> 	'lodging',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'meal_delivery',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'meal_takeaway',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'mosque',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'movie_rental',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'movie_theater',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'moving_company',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'museum',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'night_club',
            'category' 	=> 	'culture_entertainment',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'painter',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'park',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'parking',
            'category' 	=> 	'car_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'pet_store',
            'category' 	=> 	'animal_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'pharmacy',
            'category' 	=> 	'medical_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'physiotherapist',
            'category' 	=> 	'medical_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'place_of_worship',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'plumber',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'police',
            'category' 	=> 	'emergency_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'post_office',
            'category' 	=> 	'public_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'real_estate_agency',
            'category' 	=> 	'lodging',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'restaurant',
            'category' 	=> 	'food_drink',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'roofing_contractor',
            'category' 	=> 	'basic_home_services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'rv_park',
            'category' 	=> 	'lodging',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'school',
            'category' 	=> 	'education',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'shoe_store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'shopping_mall',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'spa',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'stadium',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'storage',
            'category' 	=> 	'storage',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'store',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'subway_station',
            'category' 	=> 	'public_transport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'synagogue',
            'category' 	=> 	'places_worship',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'taxi_stand',
            'category' 	=> 	'public_transport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'train_station',
            'category' 	=> 	'public_transport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'travel_agency',
            'category' 	=> 	'service_shops_stores',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'university',
            'category' 	=> 	'education',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'veterinary_care',
            'category' 	=> 	'animal_care',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('place_types')->insert([
            'type'		=>	'zoo',
            'category' 	=> 	'recreation',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}