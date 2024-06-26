<x-app-layout>
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl">
                Blog Posts
            </h1>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    @if (Auth::check())
        <div class="pt-10 w-4/5 m-auto">
            <a 
                href="/blog/create"
                class="uppercase bg-blue-400 bg-transparent text-gray-700 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Create post
            </a>
        </div>
    @endif
    
    @foreach ($blogs as $blog)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-10 border-b border-gray-200">
            <div>
                <img src="{{ $blog->image_path }}" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{ $blog->title }}
                </h2>

                <span class="text-gray-500">
                    By <span class="font-bold italic text-gray-800">{{ $blog->user->name }}</span>, Created on {{ date('jS M Y', strtotime($blog->updated_at)) }}, {{$blog->updated_at->diffForHumans()}}
                </span>

                <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                    <!-- {{ $blog->description }} -->
                </p>

                <a href="/blog/read/{{ $blog->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                    Keep Reading
                </a>

                @if (isset(Auth::user()->id) && Auth::user()->id == $blog->user_id)
                    <span class="float-right">
                        <a 
                            href="/blog/{{ $blog->slug }}/edit"
                            class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                            Edit
                        </a>
                    </span>

                    <span class="float-right">
                        <form 
                            action="/blog/{{ $blog->slug }}"
                            method="POST">
                            @csrf
                            @method('delete')

                            <button
                                class="text-red-500 pr-3"
                                type="submit">
                                Delete
                            </button>
                            <!-- <x-danger-button class="ml-3">
                                {{ __('Delete') }}
                            </x-danger-button> -->
                        </form>
                    </span>
                @endif
            </div>
        </div>    
    @endforeach
</x-app-layout>