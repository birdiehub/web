import {get} from "@/assets/js/data-connector/http";
import translator from "@/lang";

const state = {
    me: undefined,
    permissions: undefined,
    roles: undefined
};

const getters = {
    me: (state) => state.me,
    mePermissions: (state) => state.permissions,
    meRoles: (state) => state.roles,
};

const actions = {
    async fetchMe({ commit }) {
        await get(`auth/me?language=${translator.language()}`,async (user) => {
            commit('setMe', user.data);

            await get(`users/${user.data.id}/access`,(access) => {
                commit('setMePermissions', access.data.permissions);
                commit('setMeRoles', access.data.roles);
            });

        });
    }
};

const mutations = {
    setMe: (state, user) => (state.me = user),
    setMePermissions: (state, permissions) => (state.permissions = permissions),
    setMeRoles: (state, roles) => (state.roles = roles)
};

export default {
    state,
    getters,
    actions,
    mutations
};