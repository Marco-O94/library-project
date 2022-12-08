import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import NotFound from '../views/NotFound.vue'
import { UserStore } from '../stores/UserStore'

const routes: Array<RouteRecordRaw> = [
  // Public Routes
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView,
    beforeEnter: (to, from, next) => {
      if (UserStore().isLogged) {
        next('/panel');
      } else {
        next();
      }
    }
  },

  // 404
  {
    path: '/:pathMatch(.*)*',
    name: 'notFound',
    component: NotFound
  },
  // Logged in Routes
  {
    path: '/panel',
    component: () => import(/* webpackChunkName: "dashboard" */ '../views/PanelView.vue'),
    children: [
      {
        path: '',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/subviews/DashboardView.vue'),
        meta: { requiresAuth: true },
      },
      {
        path: 'profile',
        name: 'profile',
        component: () => import(/* webpackChunkName: "profile" */ '../views/subviews/ProfileView.vue'),
        meta: { requiresAuth: true },
      },
    ]
  },
  {
    path: '/books',
    component: () => import(/* webpackChunkName: "books" */ '../views/BooksView.vue'),
    children: [
      {
        path: '',
        name: 'books',
        component: () => import(/* webpackChunkName: "books" */ '../views/subviews/BooksListView.vue'),

      }
    ]
  }


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !UserStore().isLogged && to.name !== 'login') {
    next('/login');
  } else {
    next();
  }

});

export default router
