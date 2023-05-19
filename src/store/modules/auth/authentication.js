import { post, get } from "@/assets/js/data-connector/api-communication-abstractor";
import { saveToStorage} from "@/assets/js/data-connector/local-storage-abstractor";
import router from '@/router';


const state = {
    me: undefined
};

const getters = {
    me: (state) => state.me
};

const actions = {
    async login({ commit }, credentials) {
        await post(`auth/login`, credentials,(json) =>  {
            saveToStorage('token', json.token);
            router.push({ name: 'Dashboard' });
        });
    },
    async register({ commit }, user) {
        await post(`auth/register`, user,(json) => {
            saveToStorage('token', json.token);
            router.push({ name: 'Dashboard' });
        });
    },
    async logout({ commit }) {
        await post(`auth/logout`, {},() =>  saveToStorage('token', ""));
    },
    async refreshAuthentication({ commit }) {
        await post(`auth/refresh`, {}, (json) =>  saveToStorage('token', json.token));
    },
    async isAuthenticated({ commit }) {
        return get(`auth/validate`,() =>  true, () =>  false);
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
