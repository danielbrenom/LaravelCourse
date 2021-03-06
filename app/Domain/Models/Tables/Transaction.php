<?php

namespace App\Domain\Models\Tables;

use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @property Product products
 */
class Transaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id'
    ];
    /**
     * @var mixed
     */
    private $deleted_at;

    public $transformer = TransactionTransformer::class;

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id','products');
    }
}
