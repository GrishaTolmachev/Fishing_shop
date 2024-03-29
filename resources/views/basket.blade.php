@extends('layouts.app')
@section ('files.css')
  <link rel="stylesheet" href="{{ URL::asset('css/index_style.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/basket.css') }}">
  @endsection


@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    
@endsection

@section('content')
<div class="catalog">
      <div class="container__catalog">
          <ul class="str__catalog">
              @foreach($categories as $category)
                <a href="{{route('showCategory',$category->alias)}}" class="category__link" data-category="{{$category->alias}}">{{$category->title}}</a>
              @endforeach
          </ul>
      </div>
    </div>

<div class="BasketContainer">
    <div class="Basket__inner">
        <h2 class="Basket__title"> Корзина </h2>
        <p class="Basket__description">Оформление заказа</p>
    </div>
</div>

<div class="panel">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Товар</th>
            <th>Кол-во</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
            <tr>
                <td>
                    
                    <a>
                        <div class="details_image_large">
                            <img src="{{$product->image}}" alt="{{$product->name}}">
                            {{ $product->name }}
                        </div>
                    </a>
                </td>
                <td>
                    <div class="quantity">
                        <form action="{{ route('basket-add-basket', $product) }}" method="POST">
                            <button type="submit" class="btn" href="">+</button>
                            @csrf
                        </form>
                        <span class="">{{$product->pivot->count}}</span>
                        <form action="{{ route('basket-remove', $product) }}" method="POST">
                            <button type="submit" class="btn" href="">-</button>
                            @csrf
                        </form>
                    </div>
                </td>
                <th>{{ $product->getPriceForCount() }} руб.</th>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Общая стоимость:</td>
                <th>{{$order->getFullPrice()}} руб.</th>
            </tr>
        </tbody>
    </table>
    
    <div class='template'>
    <div class="container">
        <div class="row-order justify-content-center">
            <form action="{{route('basket-confirm')}}" method="POST">
                <div class="main_panel">
                    <p>Данные для оформления заказа:</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер телефона: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" value="Оформить заказ">
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<footer>
    <div class="container-footer">
      <div class="row-footer">
        <div class="footer-column">
          <h4>Контакты</h4>
          <ul class="list-unstyled">
            <li>Телефон: +7 (800) 555-35-35</li>
            <li>Email: g.a.tolmachev@gmail.com</li>
            <li>Адрес: г. Пермь, ул. Профессора Дедюкина, д. 24</li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Социальные сети</h4>
          <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-facebook"></i> VK</a></li>
            <li><a href="#"><i class="fa fa-telegram"></i> Telegram</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Полезные ссылки</h4>
          <ul class="list-unstyled">
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Отзывы</a></li>
            <li><a href="#">Доставка и оплата</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="bottom-bar">
      <div class="container-footer">
        <div class="row-footer">
          <div class="col-md-6-footer">
            <p>&copy; 2023 Рыбацкий дом. Все права защищены.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  @endsection