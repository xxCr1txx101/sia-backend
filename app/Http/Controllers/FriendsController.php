<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use Exception;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function show(Friends $friends) {
        return response()->json($friends,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $friends = Friends::where('user_id','like',"%$request->key%")
            ->orWhere('user_name','like',"%$request->key%")->get();

        return response()->json($friends, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'string|required',
            'user_name' => 'string|required',
            'player_name' => 'string|required',
        ]);

        try {
            $friends = Friends::create($request->all());
            return response()->json($friends, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Friends $friends) {
        try {
            $friends->update($request->all());
            return response()->json($friends, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Friends $friends) {
        $friends->delete();
        return response()->json(['message'=>'Friends deleted.'],202);
    }

    public function index() {
        $friends = Friends::orderBy('user_id')->get();
        return response()->json($friends, 200);
    }

}
