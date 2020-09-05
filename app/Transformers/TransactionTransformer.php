<?php

namespace App\Transformers;

use App\Domain\Models\Tables\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
     * @param Transaction $transaction
     * @return array
     */
    public function transform(Transaction $transaction): array
    {
        return [
            'identifier' => (string)$transaction->id,
            'quantity' => (string)$transaction->quantity,
            'buyer' => $transaction->buyer_id,
            'product' => $transaction->product_id,
            'creation_date' => $transaction->created_at,
            'last_update' => $transaction->updated_at ?? '',
            'deletion_date' => $transaction->deleted_at ?? '',
        ];
    }

    public static function originalAttributes($index): ?string
    {
        $attributes = [
            'identifier' => 'id',
            'quantity' => 'quantity',
            'buyer' => 'buyer_id',
            'product' => 'product_id',
            'creation_date' => 'created_at',
            'last_update' => 'updated_at',
            'deletion_date' => 'deleted_at',
        ];
        return data_get($attributes, $index, null);
    }
}
