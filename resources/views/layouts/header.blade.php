
  <nav class="navbar navbar-expand-sm bg-white mb-2">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">


        <span class="navbar-brand mx-3 grow">BLOG</span>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">خانه</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">آرشیو</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">درباره بلاگ</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control p-0" type="search" placeholder="جستجو کنید .." aria-label="Search">
          <button class="searchbtn grow" type="submit"><img src="https://img.icons8.com/windows/32/000000/search--v1.png"/></button>
        </form>
      @if (auth()->check())
        @if (auth()->user()->type == 'user')
          <a href="{{ route('user.panel') }}" class="grow loginicon">{{auth()->user()->firstname}}</a>
        @elseif(auth()->user()->type == 'admin')
        <a href="{{ route('admin.panel') }}" class="grow loginicon">{{auth()->user()->firstname}}</a>
        @endif
        <a href="{{ route('logout') }}" class="grow"><img src="https://img.icons8.com/ios-glyphs/30/null/logout-rounded.png"/></a>
      @else
        <a href="{{ route('login') }}" class="grow"><img src="https://img.icons8.com/ios-glyphs/30/null/login-rounded.png"/></a>
      @endif
      


      </div>
    </div>
  </nav>

