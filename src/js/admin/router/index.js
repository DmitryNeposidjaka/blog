import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const router = new Router({
  routes: [
/*    {
      path: '/',
      name: 'home',
      component: Home,
      children: [],
      meta: { requiresAuth: true },
    },
    {
      path: '/auth',
      name: 'Auth',
      component: Authorize,
    },*/
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
