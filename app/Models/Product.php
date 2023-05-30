<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Class Product
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property float $price
 * @property string|null $image
 * @property int $category_id
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $category
 * @property-read int|null $category_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @mixin \Eloquent
 */
/**
 * Модель Product представляет товар в магазине.
 */
class Product extends Model
{
    /**
     * Заполняемые атрибуты модели.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'description', 'price','image','category_id'];
    
    /**
     * Получить категорию, которой принадлежит товар.
     */
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Получить цену для заданного количества товара.
     *
     * @return float
     */
    public function getPriceForCount() {
        if(!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
}