import {get, post, put, remove} from "@/assets/js/data-connector/http";
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
        return post(`players?language=${translator.language()}`, player,(json) => {
            store.dispatch("createNotification", {'type': 'success', 'content': `Player ${json.data.first_name} ${json.data.last_name} created`});
            router.push('/players');
        });
    },
    async deletePlayer({ commit }, playerId) {
        return remove(`players/${playerId}?language=${translator.language()}`,(json) => {
            store.dispatch("createNotification", {'type': 'error', 'content': `Player deleted`});
            router.push('/players');
        });
    },
    async editPlayer({ commit }, { playerId, changes }) {
        return put(`players/${playerId}?language=${translator.language()}`, changes,(json) => {
            store.dispatch("createNotification", {'type': 'success', 'content': `Player ${json.data.first_name} ${json.data.last_name} updated`});
            router.push(`/players/${playerId}`);
        });
    },
}

export default {
    actions
}
