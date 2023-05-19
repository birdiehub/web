import { createStore } from "vuex";

// modules
import authentication from "@/store/modules/auth/authentication";
import countries from "@/store/modules/countries/countries";
import players from "@/store/modules/players/players";

import notification from "@/store/modules/notification";


const store = createStore({
    modules: {
        authentication,
        countries,
        players,
        notification
    }
});

export default store;
