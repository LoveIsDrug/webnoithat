<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\Sluggable;

    class Category extends Model
    {
        use HasFactory, Sluggable;

        protected $table = 'categories';

        protected $fillable = [
            'name',
            'slug',
            'description',
            'image',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'status'
        ];

        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'name'
                ]
            ];
        }

        public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
        {
            return $this->hasMany(Product::class, 'category_id', 'id');
        }

        public function relatedProducts(): \Illuminate\Database\Eloquent\Relations\HasMany
        {
            return $this->hasMany(Product::class, 'category_id', 'id')->latest()->take(16);
        }

        public function brands(): \Illuminate\Database\Eloquent\Relations\HasMany
        {
            return $this->hasMany(Brand::class, 'category_id', 'id')->where('status', '0');
        }
    }
