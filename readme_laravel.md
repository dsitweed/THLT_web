### sinh lại database
php artisan migrate:refresh --seed
### Xác định đã đăng nhập chưa 
@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
Auth::routes() được định nghĩa trong file

/vendor/laravel/framework/src/illuminate/Routing/Router.php Dưới đây là Auth::routes() của Laravel 6.3.0

- set Link cho trang chủ sau khi login xong ở RouteServiceProvider.php (biến HOME)