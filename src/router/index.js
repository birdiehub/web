import { createRouter, createWebHashHistory } from 'vue-router';

import DashboardView from "@/views/App/DashboardView.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import AuthenticationLayout from "@/layouts/AuthenticationLayout.vue";
import LoginView from "@/views/Authentication/LoginView.vue";
import RegisterView from "@/views/Authentication/RegisterView.vue";

const routes = [
  {
    path: `/`,
    redirect: `/dashboard`,
    components: {
        Layout: AppLayout
    },
    children: [
      {
        path: `/dashboard`,
        name: 'Dashboard',
        components: {
          App: DashboardView
        }
      }
    ]
  },
  {
    path: `/auth`,
    redirect: `/auth/login`,
    components: {
        Layout: AuthenticationLayout
    },
    children: [
      {
        path: `/auth/login`,
        name: 'Login',
        components: {
            Authentication: LoginView
        }
      },
      {
        path: `/auth/register`,
        name: 'Register',
        components: {
          Authentication: RegisterView
        }
      }
    ]
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

export default router;
