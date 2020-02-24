<?php

namespace App\Code;

abstract class ErrorResp
{
    const _400_BAD_REQUEST = ['status' => 400, 'code' => '400_00', 'msg' => 'BAD REQUEST'];
    const _409_City_UNIQUE = ['status' => 409, 'code' => 'City409_00', 'msg' => 'City UNIQUE'];
    const _200_C_CREATE_OK = ['status' => 200, 'code' => 'CC200_00', 'msg' => 'OK'];
    const _500_INTERNAL_ERROR = ['status' => 500, 'code' => '500_00', 'msg' => 'INTERNAL ERROR'];

    const _409_span_UNIQUE = ['status' => 409, 'code' => 'span409_00', 'msg' => 'span UNIQUE'];
    const _200_delivery_CREATE_OK = ['status' => 200, 'code' => 'DC200_00', 'msg' => 'OK'];
    const _404_C_NOT_FOUND = ['status' => 404, 'code' => 'C404_00', 'msg' => 'city NOT_FOUND'];
    const _404_D_NOT_FOUND = ['status' => 404, 'code' => 'D404_00', 'msg' => 'Delivery time NOT_FOUND'];
    const _200_delivery_Attached_OK =['status' => 200, 'code' => 'DA200_00', 'msg' => 'OK'];
    const _200_holiday_OK =['status' => 200, 'code' => 'H200_00', 'msg' => 'Holiday OK'];



    
}

?>