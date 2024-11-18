<template>
  <div class="wrapper">
    <!-- Loading State -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="spinner-border animate-spin inline-block w-8 h-8 border-4 rounded-full border-teal-600"></div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="error-state">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="error-title">Error loading data</h3>
          <p class="error-message">{{ error }}</p>
          <button @click="fetchPosts" class="error-button">
            Try Again
          </button>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div v-else>
      <!-- Search and Controls -->
      <div class="controls">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search..."
          class="input-field"
        />
        <select v-model="pageSize" class="input-field">
          <option :value="5">5 per page</option>
          <option :value="10">10 per page</option>
          <option :value="20">20 per page</option>
        </select>
      </div>

      <table class="table-container">
        <thead>
          <tr>
            <th v-for="header in headers" :key="header.key" @click="sortBy(header.key)">
              <div class="header-cell">
                {{ header.label }}
                <span v-if="sortKey === header.key" class="sort-indicator">
                  {{ sortOrder === 'asc' ? '↑' : '↓' }}
                </span>
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in paginatedAndFilteredPosts" :key="post.id">
            <td>{{ post.id }}</td>
            <td>
              <router-link :to="{ name: 'PostDetail', params: { id: post.id }}">
                {{ post.judul }}
              </router-link>
            </td>
            <td>{{ post.body }}</td>
            <td>{{ formatDate(post.created_at) }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        <button 
          @click="currentPage--"
          :disabled="currentPage === 1"
          class="pagination-button"
        >
          <
        </button>
        <button
          v-for="page in totalPages"
          :key="page"
          @click="handlePageClick(page)"
          :class="['pagination-button', { active: currentPage === page }]"
        >
          {{ page }}
        </button>
        <button
          @click="currentPage++"
          :disabled="currentPage >= totalPages"
          class="pagination-button"
        >
          >
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'DataTable',
  
  data() {
    return {
      posts: [],
      loading: true,
      error: null,
      searchQuery: '',
      currentPage: 1,
      pageSize: 5,
      sortKey: 'id',
      sortOrder: 'asc',
      headers: [
        { key: 'id', label: 'ID' },
        { key: 'judul', label: 'Judul' },
        { key: 'body', label: 'Body' },
        { key: 'created_at', label: 'Created At' }
      ]
    }
  },

  computed: {
    filteredPosts() {
      return this.posts.filter(post => {
        const searchRegex = new RegExp(this.searchQuery, 'i')
        return (
          searchRegex.test(post.judul) ||
          searchRegex.test(post.body) ||
          searchRegex.test(post.id.toString())
        )
      }).sort((a, b) => {
        const aVal = a[this.sortKey]
        const bVal = b[this.sortKey]
        const modifier = this.sortOrder === 'asc' ? 1 : -1
        
        if (typeof aVal === 'string') {
          return aVal.localeCompare(bVal) * modifier
        }
        return (aVal - bVal) * modifier
      })
    },

    paginatedAndFilteredPosts() {
      const start = (this.currentPage - 1) * this.pageSize
      const end = start + this.pageSize
      return this.filteredPosts.slice(start, end)
    },

    totalPages() {
      return Math.ceil(this.filteredPosts.length / this.pageSize)
    }
  },

  mounted() {
    this.fetchPosts()
  },

  methods: {
    async fetchPosts() {
      this.loading = true
      this.error = null
      
      try {
        const response = await axios.get('http://localhost/api/posts')
        this.posts = response.data.data || response.data // Handle both formats
        this.loading = false
      } catch (error) {
        this.error = error.response?.data?.message || error.message
        this.loading = false
        console.error('Error fetching posts:', error)
      }
    },

    sortBy(key) {
      if (this.sortKey === key) {
        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc'
      } else {
        this.sortKey = key
        this.sortOrder = 'asc'
      }
    },

    formatDate(date) {
      return new Date(date).toLocaleString()
    },

    handlePageClick(page) {
      this.currentPage = page
    }
  }
}
</script>

<style>

@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');

:root {
  --blue: rgb(42, 79, 192); /* Teal utama */
  --green: rgba(13, 71, 82, 1); /* Teal gelap untuk hover */
  --yellow: rgba(255, 234, 167, 0.8); /* Warna pendukung */
  --orange: rgba(240, 144, 84, 1); /* Aksen */
  --dark-bg: rgba(13, 71, 82, 1); /* Latar belakang gelap */
  --light-bg: rgba(224, 242, 241, 1); /* Teal terang */
  --text: rgb(0, 0, 0); /* Teks utama */
  --error-bg: rgba(255, 0, 0, 0.1); /* Latar error */
  --error-text: rgba(255, 0, 0, 0.8); /* Teks error */
}

body {
  background: var(--light-bg);
  font-family: 'Open Sans', sans-serif;
}

.wrapper {
  width: 100%;
  max-width: 1000px;
  margin: 10px auto;
  padding: 15px;
  border-radius: 16px;
  position: relative;
  overflow: hidden;
}

/* Animasi Spin */
@keyframes spin {
  to { transform: rotate(360deg); }
}

.animate-spin {
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-top: 4px solid var(--blue);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

/* Error State */
.error-state {
  background: var(--error-bg);
  color: var(--error-text);
  padding: 20px;
  border-radius: 8px;
}

.error-title {
  font-size: 1.125rem;
  font-weight: 700;
}

.error-message {
  margin-top: 0.5rem;
  font-size: 1rem;
}

.error-button {
  margin-top: 0.5rem;
  background: transparent;
  border: none;
  color: var(--error-text);
  text-decoration: underline;
  cursor: pointer;
  font-size: 1rem;
}

.error-button:hover {
  color: rgba(255, 0, 0, 1);
}

/* Kontrol (Search dan Page Size) */
.controls {
  margin-bottom: 24px;
  display: flex;
  gap: 16px;
}

.input-field {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(38, 166, 154, 0.3);
  border-radius: 12px;
  padding: 12px 16px;
  color: var(--text);
  transition: all 0.3s ease;
}

.input-field:focus {
  border-color: rgba(38, 166, 154, 0.8);
  box-shadow: 0 0 0 4px rgba(38, 166, 154, 0.1);
}

/* Tabel Data */
.table-container {
  width: 100%;
  font-size: 0.875rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table-container th,
.table-container td {
  padding: 12px 15px;
  text-align: left;
}

.table-container th {
  background: rgb(216, 221, 229);
  color: black;
  padding: 16px;
  font-weight: 500;
  letter-spacing: 0.5px;
  border-radius: 2px;
}

.table-container tbody tr {
  background: rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
}

.table-container tbody tr:nth-child(even) {
  background: rgba(240, 240, 255, 0.3);
}

.table-container tbody tr:hover {
  background: rgba(38, 68, 166, 0.6);
  transform: translateY(-1px);
}

.table-container tbody td {
  color: var(--text);
}

.table-container tbody a {
  color: var(--blue);
  text-decoration: none;
  transition: color 0.3s ease;
}

.table-container tbody a:hover {
  color: var(--orange);
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  gap: 5px;
}

.pagination-button {
  padding: 8px 12px;
  border: 1px solid var(--light-bg);
  border-radius: 4px;
  background: rgba(38, 166, 154, 0.1);
  color: var(--dark-bg);
  cursor: pointer;
  transition: background 0.3s, color 0.3s;
}

.pagination-button:hover {
  background: var(--light-bg);
  color: #fff;
}

.pagination-button.active {
  background: var(--blue);
  color: #fff;
}

.pagination-button[disabled] {
  cursor: not-allowed;
  opacity: 0.5;
}

/* Keyframe Transition */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

</style>
