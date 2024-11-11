// resources/js/components/PostDetail.vue
<template>
  <div class="max-w-4xl mx-auto p-6">
    <div v-if="loading" class="text-center">
      Loading...
    </div>
    <div v-else-if="error" class="text-red-500">
      {{ error }}
    </div>
    <article v-else class="prose lg:prose-xl">
      <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>
      <div class="text-gray-600 mb-4">
        Posted on {{ formatDate(post.created_at) }}
      </div>
      <div class="content" v-html="post.content"></div>
    </article>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'PostDetail',
  data() {
    return {
      post: null,
      loading: true,
      error: null
    }
  },
  methods: {
    async fetchPost() {
      try {
        const response = await axios.get(`/api/posts/${this.$route.params.id}`);
        this.post = response.data;
        this.loading = false;
      } catch (err) {
        this.error = 'Failed to load post';
        this.loading = false;
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
    }
  },
  created() {
    this.fetchPost();
  }
}
</script>