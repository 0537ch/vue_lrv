import { createRouter, createWebHistory } from 'vue-router';
import Index from '@/components/Posts/Index.vue'
import PostDetail from '@/components/Posts/PostDetail.vue'

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index,
        alias: '/blog'  // menambahkan alias untuk konsistensi dengan Laravel route
    },
    {
        path: '/artikel/:id',
        name: 'PostDetail',
        component: PostDetail,
        props: true // Untuk mengakses params.id sebagai prop
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;