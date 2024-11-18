<template>
    <div>
      <h1>Articles</h1>
      <button @click="$router.push('/create')">Create Article</button>
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
      <table class="article-table" v-if="articles.length">
        <thead>
          <tr>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="article in articles" :key="article.id">
            <td>{{ article.title }}</td>
            <td>
              <button @click="$router.push(`/edit/${article.id}`)">Edit</button>
              <button @click="deleteArticle(article.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <p v-else>No articles found.</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        articles: [],
        errorMessage: '',
      };
    },
    async created() {
      this.fetchArticles();
    },
    methods: {
      async fetchArticles() {
        try {
          const response = await axios.get('/api/articles');
          this.articles = response.data.data;
        } catch (error) {
          this.errorMessage = 'Failed to load articles. Please try again.';
          console.error(error);
        }
      },
      async deleteArticle(id) {
        if (confirm('Are you sure you want to delete this article?')) {
          try {
            await axios.delete(`/api/articles/${id}`);
            this.fetchArticles();
          } catch (error) {
            console.error(error);
          }
        }
      },
    },
  };
  </script>
  
  <style>
  .article-table {
    width: 100%;
    border-collapse: collapse;
  }
  .article-table th,
  .article-table td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  .article-table th {
    background-color: #f4f4f4;
    text-align: left;
  }
  .error {
    color: red;
    margin-bottom: 10px;
  }
  </style>
  