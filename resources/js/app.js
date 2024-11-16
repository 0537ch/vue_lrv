import './bootstrap';
import { createApp } from 'vue'; 
import PostsIndex from './components/Posts/Index.vue';
import Profile from './components/Posts/Profile.vue';
import router from './router'; 

const app = createApp({})
  .component('Profile', Profile)
  .component('PostsIndex', PostsIndex)
  .use(router);
  
app.mount('#app');
