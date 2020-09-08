<?php


namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;
use Throwable;

class ApiBaseController extends BaseController
{
    use ApiResponser, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @throws Throwable
     */
    protected function allowAdminAction(): void
    {
        throw_if(Gate::denies('admin-action'), new AuthorizationException('This action is unauthorized'));
    }
}
