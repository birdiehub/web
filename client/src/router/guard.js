import store from "@/store";

export async function routeGuard(to, from, next) {

    if (to.meta.protected) {
        await routeAuthenticated(to, from, next);
    }
    else if (to.path.startsWith('/auth/') ){
        await routeAuthenticate(to, from, next);
    }
    else {
        next();
    }
}

async function routeAuthenticated(to, from, next) {
    await store.dispatch('isAuthenticated').then(async (isAuthenticated) => {
        if (!isAuthenticated) {
            next('/auth/login');
        } else {
            await routeAccess(to, from, next);
        }
    });
}

async function routeAuthenticate(to, from, next) {
    await store.dispatch('isAuthenticated').then((isAuthenticated) => {
        // auth routes are not accessible when authenticated
        if (isAuthenticated) {
            next(from.path.startsWith('/auth/') ? '/dashboard' : from.path);
        } else {
            next();
        }
    });
}

async function routeAccess(to, from, next) {
    await store.dispatch('fetchMe').then(async () => {
        await store.dispatch('meHasPermissions', to.meta.permissions).then((hasPermissions) => {
            hasPermissions ? next() : next(from.path);
        });
    });
}


