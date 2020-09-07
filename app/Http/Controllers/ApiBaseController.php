<?php


namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiBaseController extends BaseController
{
    use ApiResponser, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth:api');
    }
}
