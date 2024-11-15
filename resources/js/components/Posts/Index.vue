<template>
  <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200 rounded-lg">
    <!-- Loading State -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="bg-red-50 p-4 rounded-md">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">Error loading data</h3>
          <p class="text-sm text-red-700 mt-1">{{ error }}</p>
          <button 
            @click="fetchPosts" 
            class="mt-2 text-sm text-red-800 hover:text-red-900 font-medium"
          >
            Try Again
          </button>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div v-else class="min-w-full align-middle">
      <!-- Search and Controls -->
      <div class="mb-4 flex justify-between items-center">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search..."
          class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <select
          v-model="pageSize"
          class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option :value="5">5 per page</option>
          <option :value="10">10 per page</option>
          <option :value="20">20 per page</option>
        </select>
      </div>

      <table class="min-w-full divide-y">
        <div class="table-container">
        <thead>
          <tr>
            <th 
              v-for="header in headers" 
              :key="header.key"
              class="px-6 py-3 bg-gray-50 text-left"
              @click="sortBy(header.key)"
            >
              <div class="flex items-center cursor-pointer">
                <span class="text-xs leading-4 font-medium text-black uppercase tracking-wider">
                  {{ header.label }}
                </span>
                <span v-if="sortKey === header.key" class="ml-2">
                  {{ sortOrder === 'asc' ? '↑' : '↓' }}
                </span>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white bg-opacity-80 divide-y divide-gray-200 divide-solid">
          <tr 
            v-for="post in paginatedAndFilteredPosts" 
            :key="post.id"
            class="hover:bg-gray-50"
          > 
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
              {{ post.id }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
              <router-link 
                  :to="{ name: 'PostDetail', params: { id: post.id }}"
                  class="text-blue-500 hover:underline">
                  {{ post.judul }}
              </router-link>
            </td>
            <td class="px-6 py-4 whitespace-normal text-sm leading-5 text-gray-900">
              {{ post.body }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
              {{ formatDate(post.created_at) }}
            </td>
          </tr>
        </tbody>
      </div>
      </table>

      <!-- Pagination -->
      <div class="mt-4 flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
          <button
            @click="currentPage--"
            :disabled="currentPage === 1"
            class="pagination-button"
          >
            Previous
          </button>
          <button
            @click="currentPage++"
            :disabled="currentPage >= totalPages"
            class="pagination-button"
          >
            Next
          </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium">{{ paginationStart + 1 }}</span>
              to
              <span class="font-medium">{{ paginationEnd }}</span>
              of
              <span class="font-medium">{{ filteredPosts.length }}</span>
              results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
              <button
                v-for="page in totalPages"
                :key="page"
                @click="handlePageClick(page)"
                :class="[
                  'pagination-button',
                  currentPage === page ? 'bg-blue-50 text-blue-600' : 'bg-white'
                ]"
              >
                {{ page }}
              </button>
            </nav>
          </div>
        </div>
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
    },

    paginationStart() {
      return (this.currentPage - 1) * this.pageSize
    },

    paginationEnd() {
      const end = this.paginationStart + this.pageSize
      return Math.min(end, this.filteredPosts.length)
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
      console.log("Page clicked:", page)
      this.currentPage = page
    }
  }
}
</script>

<style>
.table-container {
  background-color: rgba(255, 255, 255, 0.198); /* Warna latar belakang putih dengan 80% opacity */
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(8px); /* Efek blur pada background */
}

.table-container table {
  background-color: rgba(36, 79, 123, 0.8); /* Warna biru dengan transparansi */
  opacity: 0.9;
  color: white;
}

.table-container th,
.table-container td {
  padding: 12px 16px;
  text-align: left;
}

.table-container th {
  background-color: #6c8dadb0; /* Warna solid untuk header */
  color: #fff;
}

.table-container tbody tr:hover {
  background-color: rgba(108, 142, 173, 0.2); /* Soft blue dengan transparansi */
  border-radius: 1rem;
  transition: all 0.3s ease-in-out;
}

.pagination-button {
  cursor: pointer;
  padding: 8px 12px;
  border: 1px solid #d1d5db;
  margin: 0 2px;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.7); /* Transparansi untuk tombol pagination */
  color: #1f2937;
  transition: background-color 0.3s;
}

.pagination-button:hover {
  background-color: rgba(255, 255, 255, 0.9);
}

.pagination-button[disabled] {
  cursor: not-allowed;
  color: #a1a1aa;
  background-color: rgba(243, 244, 246, 0.5);
}

</style>
