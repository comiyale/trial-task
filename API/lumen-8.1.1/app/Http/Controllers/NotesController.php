<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\TagsAndNotes;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;

class NotesController extends Controller
{

    public function getNotes()
    {
        $notes = \App\Models\Notes::where('status', 'ACTIVE')->with('tags')->orderBy('id', 'DESC')->get();
        return response(['data' => $notes, 'message' => 'Notes data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function getNote($id)
    {
        $note = Notes::find($id);
        $tag = \App\Models\TagsAndNotes::where('notes_id', $note->id)->get();

        $noteObj = $note;
        $noteObj->tag = $tag;
        
        return response(['data' => $noteObj, 'message' => 'get note by id!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function createNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'tags' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();

        $status = $input['status'];
        $title = $input['title'];
        $description = $input['description'];
        $tags = $input['tags'];

        $noteObj = Notes::create([
            'status' => $status,
            'title' => $title,
            'description' => $description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $saved = $noteObj->save();

        foreach($tags as $tag){
            $tagObj = Tags::find($tag);

            $notesTagsObj = TagsAndNotes::create([
                'notes_id' => $noteObj->id,
                'tags_id' => $tag,
                'tag_name' => $tagObj->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);  
        }

        if ($saved) {
            return response(['data' => [
                'status' => $status,
                'title' => $title,
            ], 'message' => 'Note created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'status' => $status,
                'title' => $title,
            ], 'message' => "unable to create note, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updateNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();

        $status = $input['status'];
        $title = $input['title'];
        $id = $input['id'];
        $description = $input['description'];
        $tags = $input['tags'];

        $noteObj = Notes::findOrFail($id);
        $noteObj->title = $title;
        $noteObj->status = $status;
        $noteObj->description = $description;
        $noteObj->updated_at = Carbon::now();
        $saved = $noteObj->save();

        if(!empty($tags)){
            $resultSet = TagsAndNotes::where('note_id', $noteObj->id)->get();

            if(!empty($resultSet)){
                foreach($resultSet as $r){
                    TagsAndNotes::findOrFail($r->id)->delete();           
                }
            }
            
            foreach($tags as $tag){
                $tagObj = Tags::find($tag["tag"]);

                $notesTagsObj = TagsAndNotes::create([
                    'notes_id' => $noteObj->id,
                    'tags_id' => $tag["tag"],
                    'tag_name' => $tagObj->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);  
            }
        }

        if ($saved) {
            return response(['data' => [
                'title' => $title,
                'status' => $status,
            ], 'message' => 'Note updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'title' => $title,
                'status' => $status,
            ], 'message' => "unable to update Note, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
        $tagsObj->update($request->all());

        return response()->json($tagsObj, 200);
    }

    public function deleteNote($id)
    {
        $resultSet = Notes::find($id);
        if(!empty($resultSet)){
            Notes::findOrFail($id)->delete();
            return response('Deleted Successfully', env('HTTP_SERVER_CODE_OK'));
        }else{
            return response('ID does not exit', env('HTTP_SERVER_CODE_BAD_REQUEST'));
        }
    }
}
