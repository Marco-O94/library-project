import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import BooksView from '../views/BooksView.vue'
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
  // Logged in routes
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import(/* webpackChunkName: "dashboard" */ '../views/DashboardView.vue')
    
  }

  /**
   * Use the lazyload pattern to load the views only when needed.
   * component: () => import(/* webpackChunkName: "pagename" */ /* '../views/AboutView.vue')
   */
  

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
/*router.beforeEach(async (to, from) => {
  if (
    // make sure the user is authenticated
    !UserStore.isLogged &&
    // ❗️ Avoid an infinite redirect
    to.name !== 'Login'
  ) {
    // redirect the user to the login page
    return { name: 'Login' }
  }
})*/
/*
router.beforeEach(async (to) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login', '/', '/register'];
  const authRequired = !publicPages.includes(to.path);
  const auth = UserStore();

  if (authRequired && !auth.user) {
      auth.returnURL = to.fullPath;
      return '/login';
  }
})*/

export default router
