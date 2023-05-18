import { post, get } from "@/assets/js/data-connector/api-communication-abstractor";
import { saveToStorage} from "@/assets/js/data-connector/local-storage-abstractor";

const state = {
    token: undefined,
    me: undefined
};

const getters = {
    me: (state) => state.me
};

const actions = {
    async login({ commit }, credentials) {
        await post(`auth/login`, credentials,(json) =>  saveToStorage('token', json.token));
    },
    async fetchMe({ commit }) {
        await get(`auth/me`,(json) => commit('setMe', json.data));
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
