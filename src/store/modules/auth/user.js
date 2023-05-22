import {get} from "@/assets/js/data-connector/http";
import translator from "@/lang";

const state = {
    me: undefined,
    mePermissions: undefined,
    meRoles: undefined
};

const getters = {
    me: (state) => state.me,
    mePermissions: (state) => state.mePermissions,
    meRoles: (state) => state.meRoles,
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
    },
    meHasPermissions({ state }, target) {
        if (state.mePermissions === undefined) return false;
        return target.length === 0 || target.every(value => state.mePermissions.includes(value));
    },
};

const mutations = {
    setMe: (state, user) => (state.me = user),
    setMePermissions: (state, permissions) => (state.mePermissions = permissions),
    setMeRoles: (state, roles) => (state.meRoles = roles)
};

export default {
    state,
    getters,
    actions,
    mutations
};