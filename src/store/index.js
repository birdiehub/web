import { createStore } from "vuex";

// modules
import authentication from "@/store/modules/auth/authentication";

import notification from "@/store/modules/notification";


const store = createStore({
    modules: {
        authentication,
        notification
    }
});

export default store;
