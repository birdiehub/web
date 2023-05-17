import {now} from "moment/moment";

const state = {
    notifications: []
};

const getters = {
    notifications: (state) => state.notifications
};

const actions = {
    createNotification({ commit }, options){
        const { content, type="info" } = options;
        commit('addNotification', {id: `${now()}-${state.notifications.length}`, content: content, type: type});
    },
    removeNotification({ commit }, id) {
        commit('removeNotification', id);
    }
};

const mutations = {
    addNotification: (state, notification) => (state.notifications.push(notification)),
    removeNotification(state, id) {
        state.notifications = state.notifications.filter(notification => notification.id !== id);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
