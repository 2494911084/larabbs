        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm shadow bg-white rounded">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_route('topics.index')) }}" href="{{ route('topics.index') }}">话题</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_route('categories.show') && if_route_param('category', 1)) }}" href="{{ route('categories.show', '1') }}">分享</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_route('categories.show') && if_route_param('category', 2)) }}" href="{{ route('categories.show', '2') }}">问答</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_route('categories.show') && if_route_param('category', 3)) }}" href="{{ route('categories.show', '3') }}">教程</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_route('categories.show') && if_route_param('category', 4)) }}" href="{{ route('categories.show', '4') }}">公告</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                          <li class="nav-item notification-badge">
                            <a class="nav-link mr-2 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
                              {{ Auth::user()->notification_count }}
                            </a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->avatar }}" width="30" height="30" alt="">
                              {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">个人中心</a>
                              <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">编辑资料</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                  <form action="{{ route('logout') }}" method="post" onsubmit="return confirm('确认退出登录?');">
                                      @csrf
                                      <button class="btn btn-danger btn-block" type="submit">退出</button>
                                  </form>
                              </a>
                            </div>
                          </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
