import { get } from "@/assets/js/data-connector/api-communication-abstractor";
import translator from "@/lang";

const actions = {
    async fetchPlayer({ commit }, params) {
        const { id } = params;
        return get(`players/${id}?language=${translator.language()}`, (json) => json);
    }
}

export default {
    actions
}
