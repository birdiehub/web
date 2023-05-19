import { get } from "@/assets/js/data-connector/api-communication-abstractor";

const state = {
    languages: []
}

const getters = {
    languages: state => state.languages
}

const actions = {
    async fetchLanguages({ commit }) {
        await get("languages", (json) => commit("setLanguages", json.data));
    }
}

const mutations = {
    setLanguages: (state, languages) => (state.languages = languages)
}

export default {
    state,
    getters,
    actions,
    mutations
}
