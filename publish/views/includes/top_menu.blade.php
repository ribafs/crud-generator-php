                        <!-- Authentication Link -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @else
                        <!-- Authorization Links -->
                            @if(Auth::user()->name == 'Super')
                                <li><a class="nav-link" href=""></a></li>
                                <li><a class="nav-link" href="{{ url('users') }}"><b>Users</b></a></li>
                                <li><a class="nav-link" href="{{ url('api/products') }}"><b>Products API</b></a></li>
                                <li><a class="nav-link" href="{{ url('clients') }}"><b>Clients</b></a></li>
                                <li><a class="nav-link" href=""></a></li>
                                <li><a class="nav-link" href="{{ url('/register') }}">{{ __('Register New') }}</a></li>
                            @elseif(Auth::user()->name == 'Admin')
                                <li><a class="nav-link" href="{{ url('users') }}"><b>Users</b></a></li>
                                <li><a class="nav-link" href=""></a></li>
                                <li><a class="nav-link" href="{{ url('/register') }}">{{ __('Register New') }}</a></li>
                            @elseif(Auth::user()->name == 'Manager')
                                <li><a class="nav-link" href="{{ url('api/products') }}"><b>Products API</b></a></li>
                                <li><a class="nav-link" href="{{ url('clients') }}"><b>Clients</b></a></li>
                            @endif
                            <li><a class="nav-link" href=""></a></li>
                            <li><a class="nav-link" href=""></a></li>
                            <li><a class="nav-link" href=""></a></li>
                            <li><a class="nav-link" href=""></a></li>
                        @endguest

