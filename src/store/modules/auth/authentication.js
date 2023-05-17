import { post } from "@/assets/js/data-connector/api-communication-abstractor";
import { get } from "@/assets/js/data-connector/api-communication-abstractor";

const state = {
    token: undefined,
    me: undefined
};

const getters = {
    token: (state) => state.token,
    me: (state) => state.me
};

const actions = {
    async login({ commit }, credentials) {
        await post(`auth/login`, credentials,(json) => commit('setToken', json.token));
    },
    async fetchMe({ commit }) {
        await get(`auth/me`,(json) => commit('setMe', json.data));
    }
};

const mutations = {
    setToken: (state, token) => (state.token = token),
    setMe: (state, user) => (state.me = user)
};

export default {
    state,
    getters,
    actions,
    mutations
};
