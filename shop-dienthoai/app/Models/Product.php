<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity', // Thêm trường này
        'category_id',
        'description',
        'image', // Thêm trường này
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function visibleReviews()
    {
        // Lấy các đánh giá được phép hiển thị, sắp xếp mới nhất lên đầu
        return $this->hasMany(Review::class)->where('is_visible', true)->latest();
    }
}
