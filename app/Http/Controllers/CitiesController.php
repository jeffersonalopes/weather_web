<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view("cities.create", compact('countries'));
    }

    /**
     * Retrieve cities by country code
     *
     * @return Json
     */
    public function cities_by_country($country_code){
        $cities = City::where('country',$country_code)->get();
        echo json_encode($cities);
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = City::where("api_id",(int)$request->api_id)->first();
        $city->active = true;
        $city->display_name = $request->display_name;
        $city->day = $request->day;
        $city->cloudy_day = $request->cloudy_day;
        $city->rainy_day = $request->rainy_day;
        $city->night = $request->night;
        $city->cloudy_night = $request->cloudy_night;
        $city->rainy_night = $request->rainy_night;
        $city->save();
        $cities = City::where("active",true)->get();
        return view("cities.list",compact('cities'));
    }

    /**
     * Display a list of avaible cities.
     *
     */
    public function list(){
        $cities = City::where("active",true)->get();
        return view("cities.list",compact('cities'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $response = $this->api_call($code);
        $city  = City::where("api_id",(int)$code)->first();
        $temperture = $this->order_response($response); 

        $current_day = $temperture[array_key_first($temperture)];
        //dd($current_day);
        $background = array();
        switch ($current_day["weather"]->weather[0]->main) {
            case 'Rain':
                $background['day'] = $city->rainy_day ? $city->rainy_day : asset('/img/rainy_day.jpg') ;
                $background['night'] = $city->rainy_night ? $city->rainy_night : asset('/img/rainy_night.jpg') ;
                break;
                
            case 'Clear':
                $background['day'] = $city->day ? $city->day : asset('/img/day.jpg');
                $background['night'] = $city->night ? $city->night : asset('/img/night.jpg');
                break;
            case 'Clouds':
                $background['day'] = $city->cloudy_day ? $city->cloudy_day : asset('/img/cloudy.jpg');
                $background['night'] = $city->cloudy_night ? $city->cloudy_night : asset('/img/cloudy_night.jpg');
                break;
            default:
                $background['day'] = asset('/img/default_day.png');
                $background['night'] = asset('/img/defaut_night.jpg');
                break;
        }
        $current_day["bg"] = $background;
        
        return view("cities.show", compact('temperture','city','current_day'));
    }

    public function order_response($response){
        $dates = array();
        
        foreach($response->list as $day)
        {
            $date = date("d-m-Y", $day->dt);
            $week_day = date("l", $day->dt);
            $semana = array(
                'Sunday' => 'Domingo', 
                'Monday' => 'Segunda-Feira',
                'Tuesday' => 'Terca-Feira',
                'Wednesday' => 'Quarta-Feira',
                'Thursday' => 'Quinta-Feira',
                'Friday' => 'Sexta-Feira',
                'Saturday' => 'Sábado'
            );
            $dates[$semana[$week_day]] = array(
                "date" => $date,
                "weather" => $day,
                "week_day" => $semana[$week_day]
            );
        }
        return $dates;
    }

    public function api_call($code){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://api.openweathermap.org/data/2.5/forecast/daily?id='.$code.'&lang=pt&units=metric&APPID=9de243494c0b295cca9337e1e96b00e2&cnt=6',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
