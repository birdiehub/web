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
        commit('addNotification', {createdAt: now(), content: content, type: type});
    },
    removeNotification({ commit }, content) {
        commit('removeNotification', content);
    }
};

const mutations = {
    addNotification(state, notification) {
        if (state.notifications.find(n => n.content === notification.content)) return;
        state.notifications.push(notification)
    },
    removeNotification(state, content) {
        state.notifications = state.notifications.filter(notification => notification.content !== content);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
