<?php


namespace Modules\Products\Http\Controllers;

use App\Domain\Models\Tables\Buyer;
use App\Domain\Models\Tables\Product;
use App\Domain\Models\Tables\Transaction;
use App\Http\Controllers\ApiBaseController;
use App\Transformers\TransactionTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("transform.input:" . TransactionTransformer::class)->only(['store']);
        $this->middleware("scope:purchase-product")->only(['store']);
    }
    public function store(Product $product, Buyer $buyer, Request $request){
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request, $rules);
        if($buyer->id === $product->seller->id){
            return $this->errorResponse('Buyer and sellet must be different', Response::HTTP_CONFLICT);
        }
        if(!$buyer->isVerified() || !$product->seller->isVerified()){
            return $this->errorResponse('Users must be verified', Response::HTTP_CONFLICT);
        }
        if(!$product->isAvailable()){
            return $this->errorResponse('Product not available', Response::HTTP_CONFLICT);
        }
        if($product->quantity < $request->quantity){
            return $this->errorResponse('Not enough products to sell', Response::HTTP_CONFLICT);
        }

        return DB::transaction(function () use ($request, $product, $buyer){
            $product->quantity -= $request->quantity;
            $product->save();
            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);
            return $this->showOne($transaction, Response::HTTP_CREATED);
        });
    }
}