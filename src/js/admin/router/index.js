import Vue from 'vue';
import Router from 'vue-router';
import Home from '../layouts/MainLayout';
import Authorize from '../layouts/AuthorizeLayout';
import Posts from '../components/Posts';
import Structurize from '../components/Structurize';
import Calendar from '../components/calendar/Calendar';
import Tasks from '../components/TaskPage';



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
          meta: {
            local: {
              ru: 'Статьи',
              en: 'Posts',
            }
          }
        },
        {
          path: '/structurize',
          name: 'structurize',
          component: Structurize,
          meta: {
            local: {
              ru: 'Структуризация',
              en: 'Posts',
            }
          }
        },
        {
          path: '/calendar',
          name: 'calendar',
          component: Calendar,
          meta: {
            local: {
              ru: 'Календарь',
              en: 'Calendar',
            }
          }
        },
        {
          path: '/tasks',
          name: 'tasks',
          component: Tasks,
          meta: {
            local: {
              ru: 'Задачи',
              en: 'Tasks',
            }
          }
        },
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
