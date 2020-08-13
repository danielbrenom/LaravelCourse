<?php

namespace App\Transformers;

use App\Domain\Models\Tables\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
     * @param Category $category
     * @return array
     */
    public function transform(Category $category): array
    {
        return [
            'identifier' => (string)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'creation_date' => $category->created_at,
            'last_update' => $category->updated_at ?? '',
            'deletion_date' => $category->deleted_at ?? '',
        ];
    }
}
