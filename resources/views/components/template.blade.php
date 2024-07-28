<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('catalog') }}">INMAX</a>
            <div class="flex-grow-1 px-5 d-none d-lg-block">
                <form class="input-group" role="search" action="{{ route('catalog') }}">
                    <input class="form-control bg-light" type="search" placeholder="Type to search..." aria-label="Search" name="search">
                    <button class="btn btn-light border" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="d-flex">
                @auth
                    <a href="{{ route('notification.list') }}" class="btn">
                        <i class="fa fa-bell"></i>
                        <span class="badge text-bg-secondary">{{ request()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <a href="{{ route('cart.list') }}" class="btn"><i class="fa fa-shopping-cart"></i></a>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('invoice.list') }}" class="dropdown-item">Purchase history</a>
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                @endauth
            </div>
        </div>
        <div class="container-fluid py-2 d-block d-lg-none">
            <form class="input-group" role="search" action="{{ route('catalog') }}">
                <input class="form-control bg-light" type="search" placeholder="Type to search..." aria-label="Search" name="search">
                <button class="btn btn-light border" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </nav>

    <div class="container py-3">
        {{ $slot }}
    </div>
</body>
</html>
</body>
</html>