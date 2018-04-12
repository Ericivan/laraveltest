<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LoginController extends AuthController
{

    public function username()
    {
        return 'email';
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|exists:users',
            'password' => 'required|between:6,32',
        ]);

        if ($validator->fails()) {
            $request->request->add([
                'errors' => $validator->errors()->toArray(),
                'code' => 401,
            ]);
            return $this->sendFailedLoginResponse($request);
        }
        $request->request->add([
            'grant_type' => 'password',
            "client_id"=>5,
            "client_secret" => "Ul3SgsmzVcBrnxVIjZipuQZ2ihea0BRHg9Ges5GL",
        ]);

        $credentials = $this->credentials($request);

        if ($this->guard('api')->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        return 'fail';
    }

}
