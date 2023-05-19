import { post, get } from "@/assets/js/data-connector/api-communication-abstractor";
import { saveToStorage} from "@/assets/js/data-connector/local-storage-abstractor";
import router from '@/router';
import translator from "@/lang";


const state = {
    me: undefined
};

const getters = {
    me: (state) => state.me
};

const actions = {
    async login({ commit }, credentials) {
        await post(`auth/login?language=${translator.language()}`, credentials,(json) =>  {
            saveToStorage('token', json.token);
            router.push({ name: 'Dashboard' });
        });
    },
    async register({ commit }, user) {
        await post(`auth/register?language=${translator.language()}`, user,(json) => {
            saveToStorage('token', json.token);
            router.push({ name: 'Dashboard' });
        });
    },
    async logout({ commit }) {
        await post(`auth/logout?language=${translator.language()}`, {},() =>  saveToStorage('token', ""));
    },
    async refreshAuthentication({ commit }) {
        await post(`auth/refresh?language=${translator.language()}`, {}, (json) =>  saveToStorage('token', json.token));
    },
    async isAuthenticated({ commit }) {
        return get(`auth/validate?language=${translator.language()}`,() =>  true, () =>  false);
    },
    async fetchMe({ commit }) {
        await get(`auth/me?language=${translator.language()}`,(json) => commit('setMe', json.data));
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
