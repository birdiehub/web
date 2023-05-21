import { get } from "@/assets/js/data-connector/http";
import translator from "@/lang";
import store from "@/store";

const actions = {
    async fetchPlayer({ commit }, params) {
        const { id } = params;
        return get(`players/${id}?language=${translator.language()}`, (json) => json.data, (error) => {
            store.dispatch("createNotification", {'type': 'error', 'content': 'Player not found'});
            throw error;
        });
    }
}

export default {
    actions
}
