
import { get } from "@/assets/js/data-connector/api-communication-abstractor";
import translator from "@/lang";

const actions = {
    async fetchPlayers({ commit }, page = 1, sort = 'rank,asc', pages = 20) {
        return get(`players?language=${translator.language()}&pages=${pages}&page=${page}&sort=${sort}`, (json) => json);
    }
}

export default {
    actions
}
