<?php

namespace App\Http\Controllers;

use App\Models\Points;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;

class PointsController extends Controller
{

    public function getPoints()
    {
        $points = \App\Models\Points::orderBy('name', 'ASC')->get();
        return response(['data' => $points, 'message' => 'Notes data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function getPoint($id)
    {
        $point = Points::find($id);
        
        return response(['data' => $point, 'message' => 'get point by id!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function createPoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'x' => 'required',
            'y' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();

        $name = $input['name'];
        $x = $input['x'];
        $y = $input['y'];

        $pointObj = Points::create([
            'name' => $name,
            'x' => $x,
            'y' => $y,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $saved = $pointObj->save();

        if ($saved) {
            return response(['data' => [
                'name' => $name,
                'x' => $x,
                'y' => $y,
            ], 'message' => 'Point created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'x' => $x,
                'y' => $y,
            ], 'message' => "unable to create point, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updatePoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'x' => 'required',
            'y' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();

        $name = $input['name'];
        $x = $input['x'];
        $y = $input['y'];

        $pointObj = Point::findOrFail($id);
        $pointObj->name = $name;
        $pointObj->x = $x;
        $pointObj->y = $y;
        $pointObj->updated_at = Carbon::now();
        $saved = $pointObj->save();

        if ($saved) {
            return response(['data' => [
                'name' => $name,
                'x' => $x,
                'y' => $y,
            ], 'message' => 'Point updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'x' => $x,
                'y' => $y,
            ], 'message' => "unable to update Point, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
        $tagsObj->update($request->all());

        return response()->json($tagsObj, 200);
    }

    public function deletePoint($id)
    {
        $resultSet = Points::find($id);
        if(!empty($resultSet)){
            Points::findOrFail($id)->delete();
            return response('Deleted Successfully', env('HTTP_SERVER_CODE_OK'));
        }else{
            return response('ID does not exit', env('HTTP_SERVER_CODE_BAD_REQUEST'));
        }
    }
}
