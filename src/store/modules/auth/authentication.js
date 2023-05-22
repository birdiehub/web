import { post, get } from "@/assets/js/data-connector/http";
import { saveToStorage} from "@/assets/js/data-connector/local-storage/local-storage-abstractor";
import router from '@/router';
import translator from "@/lang";


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

};


export default {
    actions
};
