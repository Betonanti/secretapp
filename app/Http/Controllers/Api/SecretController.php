<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secret;
use App\Rules\ValidExpirationTime;
use App\Rules\ValidTtl;
use Illuminate\Http\Request;
use Validator;
use App\Api\Secrets;

class SecretController extends Controller
{
    public function store(Request $request){

        //Validation
        $validation = Validator::make($request->all(),[
            'secret' => 'min:1|max:255|required',
            'expireAfter' => 'required|date_format:Y-m-d|after:yesterday',
            'expireAfterViews' => 'min:1|required|gt:0'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(),405);
        }

        //create hash
        $response['hash'] = md5($request->secret.microtime());

        $secret = new Secrets();
        $secret->secretText = $request->secret;
        $secret->expiresAt = $request->expireAfter;
        $secret->remainingViews = $request->expireAfterViews;
        $secret->hash = $response['hash'];
        $secret->save();

        return response()->json($response,201);
    }

    public function show($hash){

        $validation = Validator::make(array('hash' => trim($hash)),[
            'hash' => [new ValidTtl(),new ValidExpirationTime()],
            'hash' => 'required|min:1|max:32|exists:secrets',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(),520);
        }

        $secret = Secrets::where('hash',$hash)->first();
        $secret->remainingViews = $secret->remainingViews-1;
        $secret->save();

        return response()->json(array('secret' => $secret->secretText),200);
    }
}
