<?php

namespace App\Modules\DeliveryTimes\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryTimes;
use App\Code\ErrorResp;
use Validator;


class DeliveryTimesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("DeliveryTimes::index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_at' => 'required|min:2|max:50',
        ]);
        if ($validator->fails()) return array(ErrorResp::_400_BAD_REQUEST, ['errors' => $validator->errors()]);
        $deliverytime = DeliveryTimes::where('delivery_at',$request->delivery_at)->first();
        
        if (!is_null($deliverytime)) return array(ErrorResp::_409_span_UNIQUE);

        $request->request->add(['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        $result = DeliveryTimes::create($request->only(['delivery_at', 'created_at', 'updated_at']));
        return $result ? array(ErrorResp::_200_delivery_CREATE_OK, ['delivery_at' => $result]) : array(ErrorResp::_500_INTERNAL_ERROR);

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
