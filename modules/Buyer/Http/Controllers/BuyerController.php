<?php

namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;

class BuyerController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("scope:read-general")->only(['index']);
        $this->middleware("can:view,buyer")->only(['show']);
    }
    public function index(): JsonResponse
    {
        $this->allowAdminAction();
        $buyers = Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }

    public function show(Buyer $buyer): JsonResponse
    {
        return $this->showOne($buyer);
    }
}
