<div class="mx-auto mt-4 max-w-6xl">
    <h1 class="my-4 text-center font-serif text-4xl font-extrabold text-sky-600 md:text-5xl">
        {{ $metaTitle }}
    </h1>

    @auth
        <div class="flex items-center justify-center">
            <a
                href="{{ route('posts.create') }}"
                class="group rounded-full bg-sky-600 p-2 text-sky-100 shadow-lg duration-300 hover:bg-sky-700 active:bg-sky-800"
            >
                <svg
                    class="h-6 w-6 duration-300 group-hover:rotate-12"
                    data-slot="icon"
                    fill="none"
                    stroke-width="1.5"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    ></path>
                </svg>
            </a>
        </div>

        @if(isset($showUserPostsButton) && $showUserPostsButton)
            <div class="flex items-center justify-center mt-4">
                <a
                    href="{{ route('posts.user') }}"
                    class="group flex items-center rounded-full bg-sky-600 px-6 py-3 text-sky-100 shadow-lg duration-300 hover:bg-sky-700 active:bg-sky-800"
                >
                    <span class="text-lg font-semibold">Mis Posts</span>
                </a>
            </div>
        @endif
    @endauth

    <div class="mx-auto mt-8 grid max-w-6xl gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach($posts as $index => $post)
            <article
                class="post-item flex flex-col overflow-hidden rounded bg-white shadow dark:bg-slate-900 {{ $index >= 30 ? 'hidden' : '' }}"
            >
                <div class="flex-1 space-y-3 p-5">
                    <h2 class="text-xl font-semibold leading-tight text-slate-800 dark:text-slate-200">
                        <a class="hover:underline" href="{{ route('posts.show', $post) }}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="hidden text-slate-500 dark:text-slate-400 md:block">
                        {{ $post->body }}
                    </p>
                    <p class="hidden text-slate-500 dark:text-slate-400 md:block">
                        {{ $post->published_at }}
                    </p>
                </div>
            </article>
        @endforeach
    </div>

</div>
@if($posts->count() > 10)
<div class="flex items-center justify-center mt-4">
    <button
        id="toggle-posts-btn"
        class="bg-sky-600 text-sky-100 px-4 py-2 rounded-full shadow-lg hover:bg-sky-700 active:bg-sky-800"
        onclick="togglePosts()"
    >
        Ver más posts
    </button>
</div>
@endif

<script>
    function togglePosts() {
        const posts = document.querySelectorAll('.post-item');
        const toggleBtn = document.getElementById('toggle-posts-btn');
        let isExpanded = toggleBtn.getAttribute('data-expanded') === 'true';

        posts.forEach((post, index) => {
            if (index >= 30) {
                post.classList.toggle('hidden', isExpanded);
            }
        });

        toggleBtn.setAttribute('data-expanded', !isExpanded);
        toggleBtn.textContent = isExpanded ? 'Ver más posts' : 'Ver menos posts';
    }
</script>
