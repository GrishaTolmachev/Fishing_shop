<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * Модель для работы с заказами.
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

    /**
     * Получить список товаров в заказе.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany Список товаров в заказе
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('count')->withTimestamps();
    }

    /**
     * Получить полную стоимость заказа.
     *
     * @return float Стоимость заказа
     */
    public function getFullPrice()
    {   
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    /**
     * Сохранить информацию о заказе.
     *
     * @param string $name Имя заказчика
     * @param string $phone Телефон заказчика
     * @return bool Возвращает true, если сохранение успешно, иначе false
     */
    public function saveOrder($name, $phone){
        if ($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
        
    }
}