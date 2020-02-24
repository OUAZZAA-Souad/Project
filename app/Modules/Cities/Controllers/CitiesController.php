<?php

namespace App\Modules\Cities\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code\ErrorResp;
use App\Models\Cities;
use App\Models\CityDeliveryTime;
use App\Models\DeliveryTimes;
use Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Cities::index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:50',
        ]);
        if ($validator->fails()) return array(ErrorResp::_400_BAD_REQUEST, ['errors' => $validator->errors()]);
        $city = Cities::where('name',$request->name)->first();
        
        if (!is_null($city)) return array(ErrorResp::_409_City_UNIQUE);

        $request->request->add(['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        log::info($request);
        $result = Cities::create($request->only(['name', 'created_at', 'updated_at']));
        return $result ? array(ErrorResp::_200_C_CREATE_OK, ['city' => $result]) : array(ErrorResp::_500_INTERNAL_ERROR);



    }

    public function attach(Request $request,$id_city){
        $validator = Validator::make($request->all(), [
            'delivery_time'=> 'required|min:1|max:50',
        ]);

        if ($validator->fails()) return array(ErrorResp::_400_BAD_REQUEST, ['errors' => $validator->errors()]);
        
        $now = date('Y-m-d H:i:s');

        $city = Cities::find($id_city);
        if (is_null($city)) return array(ErrorResp::_404_C_NOT_FOUND);

        $delivery_time = DeliveryTimes::find($request->delivery_time);
        if (is_null($delivery_time)) return array(ErrorResp::_404_D_NOT_FOUND);
        
        $result = new CityDeliveryTime;
        $result->id_city = $id_city;
        $result->id_time = $request->delivery_time;
        $result->created_at= $now;
        $result->updated_at= $now;
        
        $result->save();
        
        return $result ? array(ErrorResp::_200_delivery_Attached_OK, ['attached' => $result]) : array(ErrorResp::_500_INTERNAL_ERROR);


    }

    public function holiday ($id_city,Request $request){
        $validator = Validator::make($request->all(), [
            'start_holiday' => 'required|date_format:Y-m-d',
            'end_holiday' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) return array(ErrorResp::_400_BAD_REQUEST, ['errors' => $validator->errors()]);
        
        $city = Cities::find($id_city);
        if (is_null($city)) return array(ErrorResp::_404_C_NOT_FOUND);
        
        $data=
            [
                'Start_holiday' => $request->start_holiday,
                'end_holiday' => $request->end_holiday,
                'updated_at' => date('Y-m-d H:i:s')
            ];

        $result = Cities::find($id_city)->update($data);
        return $result ? array(ErrorResp::_200_holiday_OK, ['holiday' => $result]) : array(ErrorResp::_500_INTERNAL_ERROR);

    }

    public function get($id_city,$nbr){

        $city = Cities::find($id_city);
        if (is_null($city)) return array(ErrorResp::_404_C_NOT_FOUND);

        $delivery_time=CityDeliveryTime::where('id_city',$id_city)->get('id_time');
        $delivery_time = $delivery_time->pluck('id_time');

        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        $start_holiday= Carbon::createFromFormat('Y-m-d H:i:s', $city->start_holiday);
        $end_holiday=Carbon::createFromFormat('Y-m-d H:i:s', $city->end_holiday);
        $now=Carbon::now();

        $dates["dates"]=[];
        for($i = 0; $i < $nbr; $i++){
            $date=[];
            $date["day_name"]=$weekMap[$now->dayOfWeek];
            $date["date"]=$now->toDateTimeString();
            

            if ($now->between($start_holiday,$end_holiday,true)){
                $date["delivery_times"]="cannot offer delivery";
            }
            else {
                    $delivery_times=DeliveryTimes::whereIn('id_time', $delivery_time)->select('*')->get();
                    $delivery_at=[];
                    foreach ($delivery_times as $time) {
                        $data['id']=$time['id_time'];
                        $data['delivery_at']=$time['delivery_at'];
                        $data['created_at']=$time['created_at']->toDateTimeString();
                        $data['updated_at']=$time['updated_at']->toDateTimeString();
                        array_push($delivery_at,$data);
                    }
                    $date["delivery_times"]=$delivery_at;

                    
                
                $now = $now->addDays(1);
                
            }
            //$dates["dates"]=$date;
            array_push($dates["dates"],$date);
        }

        $result=json_encode($dates);
        return ($result);
        
        
    
     

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
