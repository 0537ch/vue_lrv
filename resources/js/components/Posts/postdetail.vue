<template>
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Loading State -->
    <div v-if="loading" class="flex justify-center items-center min-h-[400px]">
      <div class="relative">
        <div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-200 border-t-blue-600"></div>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" 
         class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-sm">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <!-- Error Icon -->
          <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">Error loading article</h3>
          <p class="text-sm text-red-700 mt-1">{{ error }}</p>
        </div>
      </div>
    </div>

    <!-- Content -->
    <article v-else class="prose prose-lg lg:prose-xl mx-auto">
      <!-- Back Navigation -->
      <nav class="mb-8">
        <button @click="$router.go(-1)" 
                class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Back to Articles
        </button>
      </nav>

      <!-- Article Header -->
      <header class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ post.judul }}</h1>
        <time :datetime="post.created_at" 
              class="text-base text-gray-600">
          {{ formatDate(post.created_at) }}
        </time>
      </header>

      <!-- Article Content -->
      <div class="prose-img:rounded-lg prose-img:shadow-lg 
                  prose-headings:text-gray-900 prose-p:text-gray-700 
                  prose-a:text-blue-600 hover:prose-a:text-blue-800
                  prose-strong:text-gray-900"
           v-html="post.body">
      </div>
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
  @apply max-w-none;
}

.prose img {
  @apply my-8 rounded-lg shadow-lg;
}

.prose p {
  @apply mb-6 leading-relaxed;
}

.prose h2 {
  @apply text-2xl font-bold mt-12 mb-6;
}

.prose h3 {
  @apply text-xl font-semibold mt-8 mb-4;
}

.prose a {
  @apply text-blue-600 hover:text-blue-800 transition-colors duration-200;
}

.prose blockquote {
  @apply border-l-4 border-gray-200 pl-4 italic text-gray-700;
}

.prose ul, .prose ol {
  @apply my-6 ml-6;
}

.prose li {
  @apply mb-2;
}

.prose pre {
  @apply bg-black rounded-lg p-4 my-6 overflow-x-auto;
}

.prose code {
  @apply bg-black px-1 py-0.5 rounded text-sm;
}
</style>