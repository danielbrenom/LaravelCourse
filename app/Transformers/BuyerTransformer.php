<?php

namespace App\Transformers;

use App\Domain\Models\Tables\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
     * @param Buyer $buyer
     * @return array
     */
    public function transform(Buyer $buyer): array
    {
        return [
            'identifier' => (string)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'is_verified' => (bool)$buyer->verified,
            'creation_date' => $buyer->created_at,
            'last_update' => $buyer->updated_at ?? '',
            'deletion_date' => $buyer->deleted_at ?? '',
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyer.user',
                    'href' => route('users.show', $buyer->id),
                ],
                [
                    'rel' => 'buyer.transactions',
                    'href' => route('buyers.transactions.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.products',
                    'href' => route('buyers.products.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.categories',
                    'href' => route('buyers.categories.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.seller',
                    'href' => route('buyers.sellers.index', $buyer->id),
                ],
            ],
        ];
    }

    public static function originalAttributes($index): ?string
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'is_verified' => 'verified',
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
            'name' => 'name',
            'email' => 'email',
            'verified' => 'is_verified',
            'created_at' => 'creation_date',
            'updated_at' => 'last_update',
            'deleted_at' => 'deletion_date',
        ];
        return data_get($attributes, $index, null);
    }
}
