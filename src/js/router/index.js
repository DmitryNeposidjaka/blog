import Vue from 'vue';
import Router from 'vue-router';
import Main from '../layouts/Main';
import Home from '../components/Home';
import PostPage from '../components/PostPage';

Vue.use(Router);

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'main',
      component: Main,
      children: [
        {
          path: '/',
          name: 'home',
          component: Home,
        },
        {
          path: '/post/:id',
          name: 'post-page',
          component: PostPage,
        }
      ]
    },
  ]
});

export default router;