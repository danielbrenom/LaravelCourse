<?php

namespace App\Domain\Models\Tables;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'pivot'
    ];

    public $transformer = CategoryTransformer::class;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
