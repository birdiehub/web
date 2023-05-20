
import { get } from "@/assets/js/data-connector/api-communication-abstractor";
import translator from "@/lang";

const actions = {
    async fetchPlayers({ commit }, params) {
        const { page = 1, sort = 'rank,asc', pageSize = 20} = params;
        return get(`players?language=${translator.language()}&pages=${pageSize}&page=${page}&sort=${sort}`, (json) => json);
    }
}

export default {
    actions
}
