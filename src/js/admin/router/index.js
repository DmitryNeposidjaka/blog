import Vue from 'vue';
import Router from 'vue-router';
import Home from '../layouts/MainLayout';
import Authorize from '../layouts/AuthorizeLayout';
import Posts from '../components/Posts';

Vue.use(Router);

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      children: [
        {
          path: '/posts',
          name: 'posts',
          component: Posts,
        }
      ],
    //  meta: {auth: true},
    },
    {
      path: '/login',
      name: 'Auth',
      component: Authorize,
    },
  ],
});

/*
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth))
  {
    if (!auth.loggedIn()) {
      next({
        path: '/auth',
        query: {redirect: to.fullPath}
      })
    }
  }
  next();
});
*/

export default router;
