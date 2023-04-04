
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webshop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{asset('img/shop.png')}}">

</head>
<body>
<script src="{{asset('js/shop.js')}}"></script>
@auth
    <?php
    $_SESSION["auth"] = Auth::user()-> id;
    $authGuard =Auth::guard(null);
    if (Auth::user()->hasRole("Admin")){
        $_SESSION["role"] = "Admin";

    }else{
        $_SESSION["role"] = "Guest";
    }


    ?>
@endauth

<header>
    <div>
        <img src="{{asset('img/shop.png')}}" alt="shopIcon">
        <h1>Webshop</h1>
    </div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div id="buttons">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="btn btn-info profile" href="{{ route('users.show',Auth::user()->id) }}" data-index="{{ Auth::user()->id }}">Show</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>


<main>
    <div id="MainContainer">
        <label for="SearchItem">Search</label>
        <input type="text" id="SearchItem">
        <div id="ItemContainerHeader">
            @if(isset($name))
                <h2>Products: <?php echo $name ?> </h2>
            @else
                <h2>Products</h2>
            @endif
        </div>
        <div id="ItemContainer">
            @foreach ($products as $product)
                <div class="Item">
                    <img src="{{ URL::asset($product -> image) }}" alt="{{ $product -> name }}">
                    <div class="ItemDescription">
                        <h2>{{ $product -> name }}</h2>
                        <p>€ {{ $product -> price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
</body>
</html>
