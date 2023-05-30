<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class CategoryAndProductCreationTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoryAndProductCreation()
    {
        // Создаем тестовые данные для категории
        $categoryData = [
            'id' => '2',
            'title' => 'Новая категория',
            'description' => 'Описание категории',
            'alias' => 'Новый алиас',
        ];

        // Добавляем категорию в базу данных
        Category::create($categoryData);
        // Проверяем, что категория была сохранен в базу данных
        $this->assertDatabaseHas('categories', $categoryData);

        // Отправляем GET-запрос на страницу категории
        $categoryAlias = $categoryData['alias'];
        $response = $this->get('/' . $categoryAlias);



        // Создаем тестовые данные для товара
        $productData = [
            'id' => '2',
            'name' => 'Новый товар',
            'price' => '200',
            'code'=> '1',
            'description' => 'Описание товара',
            'category_id' => '2',
        ];

        // Добавляем товар в базу данных
        Product::create($productData);
        // Проверяем, что товар был сохранен в базу данных
        $this->assertDatabaseHas('products', $productData);

        // Отправляем GET-запрос на страницу списка товаров
        $product_id = $productData['id'];
        $response = $this->get('/' . $categoryAlias . '/' . $product_id);


    }

}