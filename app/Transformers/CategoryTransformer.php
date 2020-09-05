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
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('categories.show', $category->id),
                ],
                [
                    'rel' => 'category.buyers',
                    'href' => route('categories.buyers.index', $category->id),
                ],
                [
                    'rel' => 'category.products',
                    'href' => route('categories.products.index', $category->id),
                ],
                [
                    'rel' => 'category.sellers',
                    'href' => route('categories.sellers.index', $category->id),
                ],
                [
                    'rel' => 'category.transactions',
                    'href' => route('categories.transactions.index', $category->id),
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
            'created_at' => 'creation_date',
            'updated_at' => 'last_update',
            'deleted_at' => 'deletion_date',
        ];
        return data_get($attributes, $index, null);
    }
}
