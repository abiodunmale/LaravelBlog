<x-app-layout>
    <div class="w-4/5 m-auto text-left">
        <div class="py-10">
            <h1 class="text-5xl">
                Update Post
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-15">
        <form 
            action="/blog/{{ $blog->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input 
                type="text"
                name="title"
                value="{{ $blog->title }}"
                class="bg-transparent block border-b-2 w-full h-20 text-5xl outline-none">

            <textarea 
                name="description"
                placeholder="Description..."
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $blog->description }}
            </textarea> 

            <div class="bg-grey-lighter pt-10">

                <div  class="pt-10 w-3/5 m-auto" >
                    <img src="{{ asset('blog_images/' . $blog->image_path) }}" alt="">
                </div>
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Select a file
                    </span>
                    <input 
                        type="file"
                        name="image"
                        class="hidden">
                </label>
            </div>

            <button    
                type="submit"
                class="uppercase mt-10 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Update Post
            </button>
        </form>
    </div>
</x-app-layout>