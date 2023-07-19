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
      }
    ]
  }
];

import HomePages from '../views/TabsHomePage.vue'

const homeRoutes: Array<RouteRecordRaw> = [
  {
    path: '/home',
    redirect: '/home/add-card'
  },
  {
    path: '/home/',
    meta: {
      requiresAuth: true // Add meta field for route guard
    },
    component: HomePages,
    children: [
      {
        path: 'add-card',
        component: () => import('@/views/CardToUser.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'add-type',
        component: () => import('@/views/AddCardType.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'scan-code',
        component: () => import('@/views/ScanQrCodePage.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }

      },
      {
        path: 'add-user',
        component: () => import('@/views/AddUser.vue'),
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
        path: 'change-password',
        component: () => import('@/views/ChangePassword.vue'),
        meta: {
          requiresAuth: true // Add meta field for route guard
        }
        },
    ]
  }
];

import VerificationPage from '../views/VereificationPage.vue'

const verificationRoutes: Array<RouteRecordRaw> = [
  {
    path: '/verification',
    component: VerificationPage,
    children: [ 
      {
        path: '/verification',
        redirect: '/verification/denied'
      },
      {
        path: 'denied',
        component: () => import('@/views/TabDenied.vue')
      },
      {
        path: 'ok',
        component: () => import('@/views/TabOk.vue')
      },
      {
        path: 'login',
        component: () => import('@/views/TabLogin.vue')
      }
    ]
  }
];


const router = createRouter({
history: createWebHistory(process.env.BASE_URL),
routes: [...loginRoutes, ...homeRoutes, ...verificationRoutes]
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