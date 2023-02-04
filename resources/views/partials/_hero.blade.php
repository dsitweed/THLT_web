<section
class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
>
<div class="grid gap-4 grid-col-3 grid-row-1">
    <div
        class="absolute top-0 left-0 w-full h-72 opacity-40 bg-no-repeat bg-left"
        style="background-image: url('images/pngegg (2).png')"
    ></div>
    <div
        class="absolute top-0 right-0 w-full h-72 opacity-40 bg-no-repeat bg-right"
        style="background-image: url('images/pngegg (2).png')"
    ></div>
    <div class="z-10">
        <h1 class="text-6xl font-bold uppercase text-white">
            Online<span class="text-black">Exam</span>
        </h1>
        <p class="text-2xl text-gray-200 font-bold my-4">
            Thi trực tuyến.
        </p>
        @guest
        <div>
            <a
                href="/login"
                class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                >Đăng Ký Ngay</a
            >
        </div>
        @else
            @if(Auth::user()->role == 'student')
            <div>
                <a
                    href="/student/join-course"
                    class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                    >Đăng Ký Khóa Học Mới</a
                >
            </div>
            @else
            <div>
                <a
                    href="/home"
                    class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                    >Khóa học của tôi</a
                >
            </div>
            @endif
        @endguest
    </div>
</div>



</section>
