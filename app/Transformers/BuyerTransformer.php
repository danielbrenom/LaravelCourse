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
        ];
    }
}
