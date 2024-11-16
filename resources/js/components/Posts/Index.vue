<template>
  <div class="wrapper">
    <!-- Loading State -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
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
          Previous
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
          Next
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
/* Impor Font Google */
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');

/* Variabel CSS */
:root {
  --blue: rgba(79, 192, 210, 1);
  --green: rgba(82, 210, 154, 1);
  --yellow: rgba(231, 196, 104, 0.7);
  --orange: rgba(235, 118, 85, 1);
  --dark-bg: rgba(0, 0, 0, 0.9);
  --light-bg: rgba(255, 255, 255, 0.1);
  --text: rgba(255, 255, 255, 0.9);
  --error-bg: rgba(255, 0, 0, 0.1);
  --error-text: rgba(255, 0, 0, 0.8);
}

/* Body */
body {
  background: var(--dark-bg);
  font-family: 'Open Sans', sans-serif;
}

/* Wrapper */
.wrapper {
  width: 100%;
  max-width: 1000px;
  margin: 20px auto;
  padding: 20px;
  background: var(--light-bg);
  color: var(--text);
  overflow: hidden;
  position: relative;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
}

/* Loading State */
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
  color: darken(var(--error-text), 10%);
}

/* Controls */
.controls {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.input-field {
  padding: 10px 15px;
  border: 1px solid #d1d5db;
  border-radius: 4px;
  font-size: 1rem;
  background: rgba(255, 255, 255, 0.8);
  color: #333;
}

.input-field:focus {
  outline: none;
  border-color: var(--blue);
  box-shadow: 0 0 0 2px rgba(79, 192, 210, 0.3);
}

/* Table Container */
.table-container {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.875rem;
}

.table-container th,
.table-container td {
  padding: 12px 15px;
  text-align: left;
}

.table-container th {
  background: var(--blue);
  color: #fff;
  cursor: pointer;
  position: relative;
}

.header-cell {
  display: flex;
  align-items: center;
}

.sort-indicator {
  margin-left: 8px;
  font-size: 0.75rem;
}

.table-container tbody tr {
  background: rgba(255, 255, 255, 0.1);
  transition: background 0.3s;
}

.table-container tbody tr:nth-child(even) {
  background: rgba(255, 255, 255, 0.05);
}

.table-container tbody tr:hover {
  background: var(--blue);
}

.table-container tbody td {
  color: #fff;
}

.table-container tbody a {
  color: var(--yellow);
  text-decoration: none;
}

.table-container tbody a:hover {
  text-decoration: underline;
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
  border: 1px solid var(--blue);
  border-radius: 4px;
  background: rgba(79, 192, 210, 0.1);
  color: var(--blue);
  cursor: pointer;
  transition: background 0.3s, color 0.3s;
}

.pagination-button:hover {
  background: var(--blue);
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

/* Keyframe Animations */
@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>
