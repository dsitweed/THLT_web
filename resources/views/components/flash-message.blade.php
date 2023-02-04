@if (Session::get('message'))
    <div x-data="{show: true}" x-init="setTimeout(()=> show = false, 3000)" x-show="show" 
        class="fixed top-10 left-1/2 transform -translate-x-1/2 bg-laravel text-white bg-green-500 px-48 py-3">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif