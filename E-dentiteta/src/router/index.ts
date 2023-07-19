import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import TabsPage from '../views/TabsPage.vue';

const loginRoutes: Array<RouteRecordRaw> = [
  {
    path: '/',
    component: TabsPage,
    children: [
      {
        path: '/',
        redirect: '/login'
      },
      {
        path: 'login',
        component: () => import('@/views/LoginPage.vue')
      },
      {
        path: 'add_acc',
        component: () => import('@/views/Add_account.vue')
      },
    ]
  }
];

import HomePages from '../views/TabsHomePage.vue'

const homeRoutes: Array<RouteRecordRaw> = [
  {
    path: '/home',
    redirect: '/home/home'
  },
  {
    path: '/home/',
    meta: {
      requiresAuth: true // Add meta field for route guard
    },
    component: HomePages,
    children: [
      {
        path: 'home',
        component: () => import('@/views/HomePage.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'id',
        component: () => import('@/views/IdPage.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'settings',
        component: () => import('@/views/SettingsPage.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'card-details',
        component: () => import('@/views/CardDetails.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'validation',
        component: () => import('@/views/QRCodeCard.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
      path: 'change-password',
      component: () => import('@/views/ChangePassword.vue'),
      meta: {
        requiresAuth: true // Add meta field for route guard
      }
      },
    ]
  }
];




const router = createRouter({
history: createWebHistory(process.env.BASE_URL),
routes: [...loginRoutes, ...homeRoutes]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Check if user is logged in
    const isLoggedIn = localStorage.getItem('awtToken');
    if (isLoggedIn!=null) {
      // User is logged in, allow access to route
      next();
    } else {
      // User is not logged in, redirect to login page
      next('/login');
    }
  } else {
    // Route does not require authentication, allow access
    next();
  }
});


export default router