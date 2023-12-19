<?php
namespace App\Http\Controllers;

use App\Docs\Swagger\Controllers\AuthControllerInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;

class AuthController extends AccessTokenController implements AuthControllerInterface
{

    public function getToken()
    {
        // Этот метод уже реализован в Laravel Passport
        return parent::issueToken(request());
    }
}
