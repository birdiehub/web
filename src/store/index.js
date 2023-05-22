import { createStore } from "vuex";

// modules
import authentication from "@/store/modules/auth/authentication";
import user from "@/store/modules/auth/user";
import countries from "@/store/modules/countries/countries";
import players from "@/store/modules/players/players";
import player from "@/store/modules/players/player";

import notification from "@/store/modules/notification";


const store = createStore({
    modules: {
        authentication,
        user,
        countries,
        players,
        player,
        notification
    }
});

export default store;
