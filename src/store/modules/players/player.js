import {get, post} from "@/assets/js/data-connector/http";
import translator from "@/lang";
import store from "@/store";
import router from "@/router";

const actions = {
    async fetchPlayer({ commit }, params) {
        const { id } = params;
        return get(`players/${id}?language=${translator.language()}`, (json) => json.data, (error) => {
            store.dispatch("createNotification", {'type': 'error', 'content': 'Player not found'});
            throw error;
        });
    },
    async createPlayer({ commit }, player) {
        console.log(player);
        return post(`players?language=${translator.language()}`, player,(json) => {
            store.dispatch("createNotification", {'type': 'success', 'content': `Player ${json.data.first_name} ${json.data.last_name} created`});
            router.push('/players');
        });
    },
}

export default {
    actions
}
