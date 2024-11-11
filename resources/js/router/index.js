// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import PostList from '../components/PostList.vue';  // Your existing list component
import PostDetail from '../components/PostDetail.vue';

const routes = [
  {
    path: '/',
    name: 'posts',
    component: PostList
  },
  {
    path: '/post/:id',
    name: 'post-detail',
    component: PostDetail
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;