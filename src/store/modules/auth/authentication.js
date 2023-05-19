import { post, get } from "@/assets/js/data-connector/api-communication-abstractor";
import { saveToStorage} from "@/assets/js/data-connector/local-storage-abstractor";

const state = {
    me: undefined
};

const getters = {
    me: (state) => state.me
};

const actions = {
    async login({ commit }, credentials) {
        return post(`auth/login`, credentials,(json) =>  saveToStorage('token', json.token));
    },
    async register({ commit }, user) {
        return post(`auth/register`, user,(json) =>  saveToStorage('token', json.token));
    },
    async logout({ commit }) {
        return post(`auth/logout`, {},() =>  saveToStorage('token', ""));
    },
    async refreshAuthentication({ commit }) {
        return post(`auth/refresh`, {}, (json) =>  saveToStorage('token', json.token));
    },
    async isAuthenticated({ commit }) {
        return get(`auth/validate`,() =>  true, () =>  false);
    },
    async fetchMe({ commit }) {
        return get(`auth/me`,(json) => commit('setMe', json.data));
    }
};

const mutations = {
    setMe: (state, user) => (state.me = user)
};

export default {
    state,
    getters,
    actions,
    mutations
};
