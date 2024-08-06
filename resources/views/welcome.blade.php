@extends('layouts.guest')

@section('content')
    <section class="bg-white">
        <div class="container min-h-screen px-6 py-12 mx-auto lg:flex lg:items-center lg:gap-12">
            <div class="wf-ull lg:w-1/2">
                <h1 class="mt-3 text-2xl font-semibold text-gray-800 md:text-3xl">{{ $setting->title }}</h1>
                <p class="mt-4 text-gray-500">
                    {{ $setting->content }}
                </p>
                <div class="flex items-center mt-6 gap-x-3">
                    <button
                        class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto">
                        <i class="mgc_phone"></i>
                        <span>Contact us</span>
                    </button>

                    <a href="{{ route('login') }}">
                        <button
                            class="w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-green-500 rounded-lg shrink-0 sm:w-auto hover:bg-green-600">
                            Go To Console
                        </button>
                    </a>
                </div>

                <div class="mt-10 space-y-6">
                    <div>
                        <a href="#" class="inline-flex items-center text-sm text-green-500 gap-x-2 hover:underline">
                            <span>Documentation</span>
                            <i class="mgc_phone"></i>
                        </a>

                        <p class="mt-2 text-sm text-gray-500">Dive in to learn all about our product.</p>
                    </div>

                    <div>
                        <a href="#" class="inline-flex items-center text-sm text-green-500 gap-x-2  hover:underline">
                            <span>Our blog</span>

                            <i class="mgc_phone"></i>
                        </a>

                        <p class="mt-2 text-sm text-gray-500">Read the latest posts on our blog.</p>
                    </div>

                    <div>
                        <a href="#" class="inline-flex items-center text-sm text-green-500 gap-x-2  hover:underline">
                            <span>Chat to support</span>
                            <i class="mgc_phone"></i>
                        </a>

                        <p class="mt-2 text-sm text-gray-500">Our friendly team is here to help.</p>
                    </div>
                </div>
            </div>

            <div class="relative w-full mt-8 lg:w-1/2 lg:mt-0">
                <img class=" w-full lg:h-[32rem] h-80 md:h-96 rounded-lg object-cover "
                    src="https://cdn.rri.co.id/berita/Bandung/o/1714482480851-images_(1)_(26)/04u7f3wo9bxhlse.jpeg"
                    alt="">
            </div>
        </div>
    </section>
@endsection
