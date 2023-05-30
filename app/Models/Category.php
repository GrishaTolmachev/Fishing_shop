<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $alias
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','alias'];

    use HasFactory;
    
    /**
     * Get the products for the category.
     */
    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
