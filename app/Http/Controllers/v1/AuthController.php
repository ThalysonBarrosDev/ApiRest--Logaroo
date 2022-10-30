<?php

namespace App\Http\Controllers\v1;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\Auth\LoginService;

class AuthController extends Controller {

    private $loginService;

    public function __construct(LoginService $loginService) {
        
        $this->loginService = $loginService;

    }
    
    public function login(Request $request) {
    
        try {

            $credentials = $request->only('email', 'password');
            $auth = $this->loginService->execute($credentials);

            return response()->json($auth, 200);

        } catch (Exception $e) {

            return response()->json(['return' => 'Erro ao realizar a autenticação, verifique!'], $e->getCode()); 

        }
        
    }

}