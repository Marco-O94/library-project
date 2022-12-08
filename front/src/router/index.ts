import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import BooksView from '../views/BooksView.vue'
import NotFound from '../views/NotFound.vue'
import { UserStore } from '../stores/UserStore'

const routes: Array<RouteRecordRaw> = [
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
  {
    path: '/books',
    name: 'books',
    component: BooksView
  },
  {
    path: '/books/:id',
    name: 'Book',
    component: () => import(/* webpackChunkName: "book" */ '../views/BookView.vue')
  },
  // Logged in routes
  {
    path: '/:pathMatch(.*)*',
    name: 'notFound',
    component: NotFound
  },
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
