<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BasketTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $categoryData;
    private $productData;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'testusername',
            'email' => 'testuser@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $this->categoryData = [
            'id' => '1',
            'title' => 'Новая категория',
            'description' => 'Описание категории',
            'alias' => 'Новый алиас',
        ];

        Category::create($this->categoryData);

        $this->productData = [
            'id' => '1',
            'name' => 'Новый товар',
            'price' => '200',
            'code'=> '1',
            'description' => 'Описание товара',
            'category_id' => '1',
        ];

        Product::create($this->productData);
    }

    public function testBasketAddRemoveConfirm()
    {
        /**
         * Basket Add
         */
        // Добавляем товар в корзину
        $response = $this->actingAs($this->user)->post('/basket/add/' . $this->productData['id']);

        // Проверяем, что запрос был успешным и произошло перенаправление
        $response->assertStatus(302)->assertRedirect();

         // Проверяем, что товар был добавлен в корзину
        $this->assertDatabaseHas('order_product', [
            'product_id' => $this->productData['id'],
        ]);

        /**-------------------------------------------------------------
         * Basket Remove
         */
        // Отправляем POST-запрос для удаления товара из корзины
        $response = $this->actingAs($this->user)->post('/basket/remove/' . $this->productData['id']);

        // Проверяем, что запрос был успешным и произошло перенаправление
        $response->assertStatus(302)->assertRedirect();

        // Проверяем, что товар был удален из корзины
        $this->assertDatabaseMissing('order_product', [
            'product_id' => $this->productData['id'],
        ]);

        /**-------------------------------------------------------------
         * Basket Confirm
         */
        // Отправляем POST-запрос для добавления товара в корзину
        $response = $this->actingAs($this->user)->post('/basket/add/' . $this->productData['id']);
        $response->assertStatus(302)->assertRedirect();

        // Подготовка данных для подтверждения заказа
        $requestData = [
            'name' => 'John Doe',
            'phone' => '123456789',
        ];

        // Отправляем POST-запрос для подтверждения заказа
        $response = $this->actingAs($this->user)->post('/basket/place', $requestData);
        $response->assertStatus(302)->assertRedirect();

        // Проверяем, что заказ успешно сохранен
        $this->assertDatabaseHas('orders', [
            // Проверяем соответствие данных заказа
            'name' => $requestData['name'],
            'phone' => $requestData['phone'],
            // Проверяем, что заказ связан с пользователем
            'user_id' => $this->user->id,
        ]);

        }
}