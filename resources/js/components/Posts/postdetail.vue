<template>
    <div class="max-w-4xl mx-auto p-6">
        <div v-if="loading" class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
        </div>
        
        <div v-else-if="error" class="bg-red-50 p-4 rounded-md">
            <div class="flex">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Error loading article</h3>
                    <p class="text-sm text-red-700 mt-1">{{ error }}</p>
                </div>
            </div>
        </div>

        <article v-else class="prose lg:prose-xl">
            <!-- Back button -->
            <div class="mb-6">
                <button @click="$router.push('/')" class="text-blue-600 hover:text-blue-800">
                    ← Back to Articles
                </button>
            </div>

            <h1 class="text-3xl font-bold mb-4">{{ post.judul }}</h1>
            <div class="text-gray-600 mb-4">
                {{ formatDate(post.created_at) }}
            </div>
            <div class="prose max-w-none" v-html="post.body"></div>
        </article>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PostDetail',
    props: {
        id: {
            type: [Number, String],
            required: false
        }
    },
    data() {
        return {
            post: null,
            loading: true,
            error: null
        }
    },
    methods: {
        async fetchPost() {
            this.loading = true;
            this.error = null;
            
            try {
                // Menggunakan id dari route params jika tidak ada dari props
                const postId = this.id || this.$route.params.id;
                const response = await axios.get(`/api/posts/${postId}`);
                
                if (response.data.status === 'success') {
                    this.post = response.data.data;
                } else {
                    throw new Error('Failed to load article');
                }
            } catch (err) {
                console.error('Error:', err);
                this.error = err.response?.data?.message || 'Failed to load article';
            } finally {
                this.loading = false;
            }
        },
        formatDate(date) {
            if (!date) return '';
            return new Date(date).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    },
    created() {
        this.fetchPost();
    },
    // Tambahkan watch untuk handle perubahan route
    watch: {
        '$route'(to, from) {
            if (to.params.id !== from.params.id) {
                this.fetchPost();
            }
        }
    }
}
</script>

<style>
.prose {
    max-width: 65ch;
    margin: 0 auto;
}

.prose img {
    margin: 2rem auto;
}

.prose p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
}
</style>