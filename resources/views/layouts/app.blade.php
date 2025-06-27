<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Project CRUD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/css/style.css'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">🚀 {{ __('app.welcome') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-light"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                @if(auth()->user()->hasRole(['admin', 'manager']))
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ __('app.select_user') }}
                        </button>
                        @if($users)
                            <ul class="dropdown-menu" aria-labelledby="userDropdown" style="min-width: 280px;">
                                @foreach($users as $user)
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                           href="{{ route('users.show', $user->id) }}">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default/default.jpg') }}"
                                                     alt="{{ $user->name }}" class="rounded-circle me-2 rounded-avatar">
                                                <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                            </div>
                                            <span class="badge bg-secondary text-capitalize">{{ $user->role }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            @endauth

            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Language Switcher Dropdown -->
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="languageDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" title="{{ __('app.select_language') }}" style="cursor:pointer;">
                        🌐 <span class="ms-1 d-none d-sm-inline">{{ strtoupper(app()->getLocale()) }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                               href="{{ route('lang.switch', 'en') }}">
                                {{ __('app.english') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'hy' ? 'active' : '' }}"
                               href="{{ route('lang.switch', 'hy') }}">
                                {{ __('app.armenian') }}
                            </a>
                        </li>
                    </ul>
                </li>

                @auth
                    <li class="nav-item me-3">
                        <a class="nav-link fw-semibold" href="{{ route('products.index') }}">📦 {{ __('app.products') }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth()->user()->avatar ? asset('storage/' . Auth()->user()->avatar) : asset('storage/avatars/default/default.jpg') }}"
                                 alt="{{ Auth()->user()->name }}" class="rounded-circle rounded-avatar" />
                            <span class="ms-2">{{ Auth()->user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li class="px-3 py-2 d-flex justify-content-between align-items-center">
                                <span class="fw-semibold">{{ Auth()->user()->name }}</span>
                                <span class="badge bg-secondary text-capitalize">{{ Auth()->user()->role }}</span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.my') }}">👤 {{ __('app.profile') }}</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">🚪 {{ __('app.logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a class="nav-link fw-semibold" href="{{ route('loginPage') }}">🔐 {{__('app.login')}}</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fw-semibold" href="{{ route('registration') }}">📝 {{__('app.register')}}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="pb-5">
    @yield('content')
</main>

@if(auth()->user())
    <a href="{{ route('products.trash') }}"
       class="btn btn-danger btn-lg rounded-circle position-fixed d-flex align-items-center justify-content-center floating-trash"
       title="View Trash">
        🗑️
    </a>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
