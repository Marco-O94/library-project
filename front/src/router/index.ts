import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import HomeView from '@/views/public/HomeView.vue'
import LoginView from '@/views/public/LoginView.vue'
import RegisterView from '@/views/public/RegisterView.vue'
import NotFound from '@/views/public/NotFound.vue'
import { UserStore } from '@/stores/UserStore'
//import { BookStore } from '../stores/BookStore'



const routes: Array<RouteRecordRaw> = [
  // Public Routes
/* ----- HOME ----- */
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  /* ----- USER LOGIN ----- */
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  },
  /* ----- USER REGISTRATION ----- */
  {
    path: '/register',
    name: 'register',
    component: RegisterView,
  },
  /* ----- SHOW BOOKS PUBLICLY ----- */
  {
    path: '/books',
    component: () => import(/* webpackChunkName: "booksIndex" */ '@/views/public/BooksView.vue'),
    children: [
      
      {
        path: '',
        name: 'books',
        component: () => import(/* webpackChunkName: "booksQuery" */ '@/views/public/BooksListView.vue'),

      },
      {
        // I'm gonna use ID as a slug 😅 - But I wanted to use /category/:slug but I don't have enough time btw 😅
        path: 'show/:id',
        name: 'show',
        component: () => import(/* webpackChunkName: "bookDetails" */ '@/views/public/BookDetailsView.vue'),
        /*beforeEnter: (to, from, next) => {
          // check to.params.id / to.params.code
         if (to.params.id === BookStore().books.data.find(book => book.id === to.params.id)) return next()

         next({ name: '404' })*/

      }
    ]
  },
  // Logged in Routes
  {
    path: '/panel',
    name: 'panel',
    component: () => import(/* webpackChunkName: "panel" */ '@/views/private/PanelView.vue'),
    children: [
      /* ----- DASHBOARD ----- */
      {
        path: '',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '@/views/private/DashboardView.vue'),
        meta: { requiresAuth: true },
      },
      /* ----- EDIT PROFILE ----- */
      {
        path: 'profile',
        name: 'profile',
        component: () => import(/* webpackChunkName: "profile" */ '@/views/private/ProfileView.vue'),
        meta: { requiresAuth: true },
      },
      /* ----- ADD NEW BOOK ----- */
      {
        path: 'add',
        name: 'addBook',
        component: () => import(/* webpackChunkName: "addBook" */ '@/views/private/AddBookView.vue'),
        meta: { requiresAuth: true, requiresLibrarian: true  },
      },
      /* ----- SHOW / EDIT BOOKS ----- */
      {
        path: 'users',
        name: 'usersList',
        children: [
          {
            path: '',
            name: 'manageusers',
            component: () => import(/* webpackChunkName: "usersManage" */ '@/views/private/ManageUsersView.vue'),
            meta: { requiresAuth: true, requiresLibrarian: true },
          },
          {
            path: ':id',
            name: 'edituser',
            component: () => import(/* webpackChunkName: "editUser" */ '@/views/private/ManageUserView.vue'),
            meta: { requiresAuth: true, requiresLibrarian: true },
          },
        ]
      },
      {
        path: 'books',
        name: 'booksList',
        children: [
          {
            path: '',
            name: 'managebooks',
            component: () => import(/* webpackChunkName: "booksManage" */ '@/views/private/ManageBooksView.vue'),
            meta: { requiresAuth: true, requiresLibrarian: true },
          },
          {
            path: ':id',
            name: 'editbook',
            component: () => import(/* webpackChunkName: "editBook" */ '@/views/private/ManageBookView.vue'),
            meta: { requiresAuth: true, requiresLibrarian: true },

          },
        ]
      },
      
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
  if (to.name !== 'Login' && !UserStore().isLogged && to.meta.requiresAuth) next({ name: 'Login' })
  if(to.meta.requiresLibrarian && UserStore().user.role.name !== 'Librarian') next({ name: 'home' })
  
  next()
});



export default router
