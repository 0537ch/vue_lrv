import './bootstrap';
import { createApp } from 'vue'; 
import PostsIndex from './components/Posts/Index.vue';
import router from './router'; 

const app = createApp({})
  .component('PostsIndex', PostsIndex)
  .use(router);

app.mount('#app');
