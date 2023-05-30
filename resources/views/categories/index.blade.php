 

@extends('layouts.app')
@section ('files.css')
  <link rel="stylesheet" href="{{ URL::asset('css/index_style.css') }}">
  
  @endsection


@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')
<div class="catalog">
      <div class="container__catalog">
          <ul class="str__catalog">
          
              <!-- <a href="/udilischa" class="category__link" data-category="udilischa">Удилища</a>
          
              <a href="#" class="category__link" data-category="katushki">Катушки</a>

              <a href="" class="category__link" data-category="leska">Леска</a>

              <a href="#" class="category__link" data-category="primanki">Приманки</a> -->
              @foreach($categories as $category)
                <a href="{{route('showCategory',$category->alias)}}" class="category__link" data-category="{{$category->alias}}">{{$category->title}}</a>
              @endforeach
          </ul>
      </div>
    </div>

    <!-- Products -->

    <div class="card">
      <div class="container__card">
        <div class="row">
        <h2>{{$cat->title}}</h2>
          @foreach($cat->products as $product)
          <div class="col-md-6">
            <div class="product-card">
              <img class="card-img-top" src="{{$product->image}}" alt="Товар 1">
              <div class="card-body">
                <h3 class="card-title">{{$product->name}}</h3>
                <p class="card-text">{{$product->description}}</p>
                <a href="#" class="btn btn-primary">{{$product->price}} руб.</a>
              </div>
            </div> 
          </div>
          @endforeach
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
            <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
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