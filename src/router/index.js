import { createRouter, createWebHashHistory } from 'vue-router';
import store from "@/store";

import DashboardView from "@/views/App/DashboardView.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import AuthenticationLayout from "@/layouts/AuthenticationLayout.vue";
import LoginView from "@/views/Authentication/LoginView.vue";
import RegisterView from "@/views/Authentication/RegisterView.vue";
import PlayersView from "@/views/App/PlayersView.vue";

async function routeGuard(to, from, next) {
  await store.dispatch('isAuthenticated').then((isAuthenticated) => {
    if (to.meta.protected && !isAuthenticated) {
      next('/auth/login');
    }
    else if (to.path.startsWith('/auth/') && isAuthenticated) {
      next(from.path.startsWith('/auth/') ? '/dashboard' : from.path);
    }
    else {
      next();
    }
  });
}

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
        },
        meta: {
          protected: true
        }
      },
      {
        path: '/players',
        name: 'Players',
        components: {
          App: PlayersView
        },
        meta: {
          protected: true
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
        },
        meta: {
          protected: false
        }
      },
      {
        path: `/auth/register`,
        name: 'Register',
        components: {
          Authentication: RegisterView
        },
        meta: {
          protected: false
        }
      }
    ]
  }
];

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

router.beforeEach(routeGuard);

export default router;
