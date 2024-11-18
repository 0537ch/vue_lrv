import { createRouter, createWebHistory } from 'vue-router';
import Index from '@/components/Posts/Index.vue';
import PostDetail from '@/components/Posts/PostDetail.vue';
import ArticleForm from '@/components/Posts/ArticleForm.vue';

const routes = [
  {
    path: '/',
    name: 'Index',
    component: Index,
    alias: '/blog', // Alias untuk konsistensi dengan Laravel
  },
  {
    path: '/artikel/:id',
    name: 'PostDetail',
    component: PostDetail,
    props: true, // Untuk mengakses params.id sebagai prop
  },
  {
    path: '/create',
    name: 'CreateArticle',
    component: ArticleForm,
  },
  {
    path: '/edit/:id',
    name: 'EditArticle',
    component: ArticleForm,
    props: true, // Untuk mengakses params.id sebagai prop
  }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
