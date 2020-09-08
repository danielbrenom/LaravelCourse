<?php


namespace Modules\Seller\Http\Controllers;


use App\Domain\Models\Tables\Product;
use App\Domain\Models\Tables\Seller;
use App\Http\Controllers\ApiBaseController;
use App\Transformers\ProductTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware("transform.input:" . ProductTransformer::class)->only(['store', 'update']);
        $this->middleware("scope:manage-product");
        $this->middleware("scope:read-general")->only(['index']);
        $this->middleware('can:view,seller')->only('index');
        $this->middleware('can:sale,seller')->only('store');
        $this->middleware('can:update,seller')->only('update');
        $this->middleware('can:delete,seller')->only('destroy');
    }

    public function index(Seller $seller): JsonResponse
    {
        return $this->showAll($seller->products);
    }

    public function store(Request $request, User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['status'] = Product::STATUS_UNAVAILABLE;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;
        $product = (new Product())->fill($data);
        $product->save();
        return $this->showOne($product);
    }

    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => Rule::in(Product::STATUS_UNAVAILABLE, Product::STATUS_AVAILABLE),
            'image' => 'image'
        ];
        $this->validate($request, $rules);
        throw_if($product->seller_id !== $seller->id,
            new HttpException(422,'Product doesn\'t belong to seller'));
        if ($request->has('status') && $product->isAvailable() && $product->categories()->count() === 0) {
            return $this->errorResponse('Active products need to have at least one category', Response::HTTP_CONFLICT);
        }
        $product->fill(array_filter($request->all()));
        if($request->hasFile('image')){
            Storage::delete($product->image);
            $product->image = $request->image->store('');
            unset($request->image);
        }
        if($product->isClean()){
            return $this->errorResponse(trans('messages.model.no_update'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $product->save();
        return $this->showOne($product);
    }

    public function destroy(Seller $seller, Product $product){
        throw_if($product->seller_id !== $seller->id,
            new HttpException(422,'Product doesn\'t belong to seller'));
        Storage::delete($product->image);
        $product->delete();
        return $this->showOne($product);
    }
}