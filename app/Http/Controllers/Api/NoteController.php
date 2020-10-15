<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Response\NoteWS;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function all(Request $request)
    {
        $query = \Auth::user()->notes();
        if ($request->has('programed')) {
            $query->whereNotNull('programed');
        }
        return response()->json(NoteWS::collection($query->get()));
    }

    public function create(Request $request)
    {
        $note = new Note($request->all());
        if ($request->input('programed_time', '') != '') {
            $note->programed = Carbon::createFromTimestampMs(
                $request->input('programed_time'));
        }
        $note->user_id = \Auth::id();
        if (!$note->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede guardar en este momento intentalo mas tarde'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => ''
        ]);
    }


    public function update($noteId,Request $request)
    {
        $note = Note::find($noteId);
        $note->fill($request->all());
        if ($request->input('programed_time', '') != '') {
            $note->programed = Carbon::createFromTimestampMs(
                $request->input('programed_time'));
        }else $note->programed = null;

        if (!$note->save()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede guardar en este momento intentalo mas tarde'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => ''
        ]);
    }

    public function destroy($noteId)
    {
        $note = Note::find($noteId);
        try {
            if (!$note->delete()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo borrar'
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => ''
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo borrar'
            ]);
        }
    }
}
