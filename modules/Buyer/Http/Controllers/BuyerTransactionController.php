<?php


namespace Modules\Buyer\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Http\Controllers\ApiBaseController;

class BuyerTransactionController extends ApiBaseController
{
    public function index(Buyer $buyer){
        return $this->showAll($buyer->transactions);
    }
}