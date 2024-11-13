// router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Index from '@/components/Posts/Index.vue'
import PostDetail from '@/components/Posts/PostDetail.vue'

const routes = [
    {
        path: '/',
        name: 'Index',
        component: Index
    },
    {
        path: '/artikel/:id',
        name: 'PostDetail',
        component: PostDetail,
        props: true // Ini penting agar params.id bisa diakses sebagai prop
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;