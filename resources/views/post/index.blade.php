<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif

        <div class="mt-4 mb-4">
            <form action="{{ route('posts.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="検索（タイトル、本文）" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-primary-button>
                    検索
                </x-primary-button>
            </form>
        </div>

        <div class="posts-container">
            @foreach($posts as $post)
                <div class="mt-4 p-8 bg-white w-full rounded-2xl">
                    <h1 class="p-4 text-lg font-semibold">
                        件名：
                        <a href="{{ route('posts.show', $post) }}" style="color: blue">
                            {{ $post->title }}
                        </a>
                    </h1>
                    <hr class="w-full">
                    <p class="mt-4 p-4">
                        {{ $post->body }}
                    </p>
                    <div class="p-4 text-sm font-semibold">
                        <p>
                            {{ $post->created_at }} / {{ $post->user->name?? '' }}
                        </p>
                    </div>
                </div>
            @endforeach
            <div class="mb-4">
                {{$posts->links()}}
            </div>
        </div>
    </div>
    @push('scripts')
    <script type="module" src="{{ Vite::asset('resources/js/search.js') }}"></script>
    @endpush
</x-app-layout>