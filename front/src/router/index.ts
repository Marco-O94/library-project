import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import NotFound from '../views/NotFound.vue'
import { UserStore } from '../stores/UserStore'
import { BookStore } from '../stores/BookStore'



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
  // Logged in Routes
  {
    path: '/panel',
    name: 'panel',
    redirect: '/panel/',
    component: () => import(/* webpackChunkName: "panel" */ '../views/PanelView.vue'),
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
    component: () => import(/* webpackChunkName: "booksIndex" */ '../views/BooksView.vue'),
    children: [
      {
        path: '',
        name: 'books',
        component: () => import(/* webpackChunkName: "booksQuery" */ '../views/subviews/BooksListView.vue'),

      },
      {
        path: 'manage',
        name: 'manage',
        component: () => import(/* webpackChunkName: "booksManage" */ '../views/subviews/ManageBooksView.vue'),
        meta: { requiresAuth: true },
        beforeEnter: (to, from, next) => {
          if (UserStore().isLogged && UserStore().user.role.name === 'Librarian') {
            next();
          } else {
            next('/panel');
          }
        }
      },
      {
        // I'm gonna use ID as a slug - But I wanted to use /category/:slug but I don't have enough time by the way
        path: 'show/:id',
        name: 'show',
        component: () => import(/* webpackChunkName: "bookDetails" */ '../views/subviews/BookDetailsView.vue'),
        /*beforeEnter: (to, from, next) => {
          // check to.params.id / to.params.code
         if (to.params.id === BookStore().books.data.find(book => book.id === to.params.id)) return next()

         next({ name: '404' })*/
        
      }
    ]
  },

  // 404
  {
    path: '/:pathMatch(.*)*',
    name: 'notFound',
    component: NotFound
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
