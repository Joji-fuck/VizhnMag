<nav class="navbar">

    <div class="burger-menu" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <ul id="nav-links">
        <li><a href="{{ route('home') }}">Читай Тюменское</a></li>
        <li><a href="/movie">Смотри Тюменское</a></li>
        <li><a href="{{ route('about') }}">О проекте</a></li>
        <li>
            <a href="/search" class="text-decoration-none" style="color: #0f3f63;">
                <i class="bi bi-search" style="font-size: 1.5rem;"></i>
            </a>
        </li>
    </ul>

</nav>
