<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;

class TagsController extends Controller
{

    public function getTags()
    {
        return response(['data' => Tags::where('status', 'ACTIVE')->orderBy('name')->get(), 'message' => 'Tags data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function getTag($id)
    {
        return response(['data' => Tags::find($id), 'message' => 'get tag by id!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function createTag(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Tags::whereName($value)->count() > 0) {
                        $fail($value . ' is already used.');
                    }
                },
            ],
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $status = $input['status'];
        $name = $input['name'];

        $tagsObj = Tags::create([
            'status' => $status,
            'name' => $name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $saved = $tagsObj->save();

        if ($saved) {
            return response(['data' => [
                'status' => $status,
                'name' => $name,
            ], 'message' => 'Tag created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'status' => $status,
                'name' => $name,
            ], 'message' => "unable to create tag, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updateTag(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'name' => 'required',
            'id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty(Tags::find($value))) {
                        $fail('ID ' . $value . ' does not exist.');
                    }

                    if(!is_numeric($value)){
                        $fail($value . ' (id) is not numeric');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();
        $status = $input['status'];
        $name = $input['name'];
        $id = $input['id'];

        $tagsObj = Tags::findOrFail($id);
        $tagsObj->name = $name;
        $tagsObj->status = $status;
        $tagsObj->updated_at = Carbon::now();
        $saved = $tagsObj->save();

        if ($saved) {
            return response(['data' => [
                'name' => $name,
                'status' => $status,
            ], 'message' => 'Tag updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'status' => $status,
            ], 'message' => "unable to update Tag Item, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
        $tagsObj->update($request->all());

        return response()->json($tagsObj, 200);
    }

    public function deleteTag($id)
    {
        $resultSet = Tags::find($id);
        if(!empty($resultSet)){
            Tags::findOrFail($id)->delete();
            return response('Deleted Successfully', env('HTTP_SERVER_CODE_OK'));
        }else{
            return response('ID does not exit', env('HTTP_SERVER_CODE_BAD_REQUEST'));
        }
    }
}
