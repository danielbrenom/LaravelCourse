<?php

namespace App\Transformers;

use App\Domain\Models\Tables\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Product $product
     * @return array
     */
    public function transform(Product $product): array
    {
        return [
            'identifier' => (string)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'stock' => $product->quantity,
            'status' => $product->status,
            'picture' => url("img/{$product->image}"),
            'seller' => (int)$product->seller_id,
            'creation_date' => $product->created_at,
            'last_update' => $product->updated_at ?? '',
            'deletion_date' => $product->deleted_at ?? '',
        ];
    }

    public function originalAttributes($index): string
    {
        $attributes = [
            'identifier' => 'id',
            'title' => 'name',
            'details' => 'description',
            'stock' => 'quantity',
            'status' => 'status',
            'picture' => 'image',
            'seller' => 'seller_id',
            'creation_date' => 'created_at',
            'last_update' => 'updated_at',
            'deletion_date' => 'deleted_at',
        ];
        return data_get($attributes, $index, null);
    }
}
