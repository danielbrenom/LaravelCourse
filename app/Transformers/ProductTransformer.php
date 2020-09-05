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
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.category',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $product->seller_id),
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $product->id),
                ],
            ],
        ];
    }

    public static function originalAttributes($index): ?string
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

    public static function transformedAttributes($index): ?string
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'title',
            'description' => 'details',
            'quantity' => 'stock',
            'status' => 'status',
            'image' => 'picture',
            'seller_id' => 'seller',
            'created_at' => 'creation_date',
            'updated_at' => 'last_update',
            'deleted_at' => 'deletion_date',
        ];
        return data_get($attributes, $index, null);
    }
}
