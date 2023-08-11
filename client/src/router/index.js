import { createRouter, createWebHashHistory } from 'vue-router';

import { routes } from './routes';
import { routeGuard } from "./guard";

const router = createRouter({
  history: createWebHashHistory(),
  routes
});

router.beforeEach(routeGuard);

export default router;
