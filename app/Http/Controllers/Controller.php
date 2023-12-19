<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Docs\Swagger\Controllers\AppControllerInterface;

class Controller extends BaseController implements AppControllerInterface
{
    use AuthorizesRequests, ValidatesRequests;
}
