<x-blog-layout meta-title="Blog" meta-description="Descripción de la página del Blog">
    <x-posts-list :metaTitle="'Blog'" :posts="$posts" :showUserPostsButton="true"/>
    <div class="flex items-center justify-center mt-4">
        <button
            id="toggle-posts-btn"
            class="bg-sky-600 text-sky-100 px-4 py-2 rounded-full shadow-lg hover:bg-sky-700 active:bg-sky-800"
            onclick="togglePosts()"
        >
            Ver más posts
        </button>
    </div>
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

            // Cambiar el estado y el texto del botón
            toggleBtn.setAttribute('data-expanded', !isExpanded);
            toggleBtn.textContent = isExpanded ? 'Ver más posts' : 'Ver menos posts';
        }
    </script>
</x-blog-layout>
