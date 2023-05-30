
  @extends ('layouts.app')  
  @section ('files.css')
  <link rel="stylesheet" href="{{ URL::asset('css/index_style.css') }}">
  
  @endsection

  @section ('content')
  
  <main>  
    <div class="catalog">
      <div class="container__catalog">
          <ul class="str__catalog">
              @foreach($categories as $category)
                <a href="{{route('showCategory',$category->alias)}}" class="category__link" data-category="{{$category->alias}}">{{$category->title}}</a>
              @endforeach
          </ul>
      </div>
    </div>
        <div class="card">
       <div class="container__card">
        <div class="row">

        @foreach($categories as $category)
        <h2>{{$category->title}}</h2>
        @foreach($category->products->take(4) as $product)
          <div class="col-md-6">
            <div class="product-card">
              <img class="card-img-top" src="{{$product->image}}" alt="Товар 1">
              <div class="card-body">
                <h3 class="card-title">{{$product->name}}</h3>
                <p class="card-text">{{$product->description}}</p>
                <form action="{{route('basket-add', $product->id)}}" method="POST">
                      <button type="submit" class="btn btn-primary" role="button">{{$product->price}} руб.</button>
                @csrf
                </form>
              </div>
            </div> 
          </div>
          @endforeach
        @endforeach
                
    </div>
  </div>
</div>

  <!-- Подключаем Bootstrap JS для работы интерактивных элементов на странице -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</main>

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