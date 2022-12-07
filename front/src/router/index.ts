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
    name: 'Login',
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
    name: 'book',
    component: () => import(/* webpackChunkName: "book" */ '../views/BookView.vue')
  },
  // Logged in routes
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardView.vue')
    
  },
  { path: '/:pathMatch(.*)*', 
    name: 'NotFound', 
    component: NotFound
  },

  /**
   * Use the lazyload pattern to load the views only when needed.
   * component: () => import(/* webpackChunkName: "pagename" */ /* '../views/AboutView.vue')
   */
  

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from) => {
  const userStore = UserStore()
  const privatePages = ['/Dashboard'];
  const authRequired = privatePages.includes(to.path);
  if (
    // make sure the user is authenticated
    !userStore.isLogged && authRequired &&
    // ❗️ Avoid an infinite redirect
    to.name !== 'Login'
  ) {
    // redirect the user to the login page
    return { name: 'Login' }
  }
})

export default router
