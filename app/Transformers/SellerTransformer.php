<?php

namespace App\Transformers;

use App\Domain\Models\Tables\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
     * @param Seller $seller
     * @return array
     */
    public function transform(Seller $seller): array
    {
        return [
            'identifier' => (string)$seller->id,
            'name' => (string)$seller->name,
            'email' => (string)$seller->email,
            'is_verified' => (bool)$seller->verified,
            'creation_date' => $seller->created_at,
            'last_update' => $seller->updated_at ?? '',
            'deletion_date' => $seller->deleted_at ?? '',
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
}
