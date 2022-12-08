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
    component: LoginView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
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
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../views/subviews/DashboardView.vue'),
        meta: { requiresAuth: true },
      },
      {
        path: 'profile',
        name: 'Profile',
        component: () => import(/* webpackChunkName: "profile" */ '../views/subviews/ProfileView.vue'),
      },
      {
        path: 'librarian',
        name: 'librarian',
        component: () => import(/* webpackChunkName: "books" */ '../views/subviews/LibrarianDash.vue'),
        beforeEnter: (to, from) => {
          if(UserStore().user.role_id != 1)
          return false
        },
      },
      {
        path: 'user',
        name: 'user',
        component: () => import(/* webpackChunkName: "user" */ '../views/subviews/UserDash.vue'),
        beforeEnter: (to, from) => {
          if(UserStore().user.role_id != 1)
          return false
        },
      }
    ]
  },


]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  const userStore = UserStore();
  const privatePages = ['/panel', '/panel/profile', '/panel/librarian', '/panel/user'];
  const authRequired = privatePages.includes(to.path);
  if (
    // make sure the user is authenticated
    !userStore.isLogged && authRequired &&
    // ❗️ Avoid an infinite redirect
    to.name !== 'login'
  ) {
    // redirect the user to the login page
    return { name: 'login' }
  }
});

export default router
