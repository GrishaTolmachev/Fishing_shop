<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    public function testRegistration()
    {

        
        $this->withoutMiddleware();
        //Создаем массив с данными пользователя
        $userData = ([
            'name' => 'testusername',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Отправляем POST-запрос для регистрации пользователя
        $response = $this->post('/register', $userData);

        // Проверяем, что регистрация прошла успешно и было выполнено перенаправление
        // 302 перенаправление на другую страницу
        $response->assertStatus(302);

        // Проверяем, что пользователь был сохранен в базе данных
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }
}