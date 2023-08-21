import { createStore } from "vuex";

// modules
import authentication from "@/store/modules/auth/authentication.js";
import user from "@/store/modules/auth/user.js";
import countries from "@/store/modules/countries/countries.js";
import players from "@/store/modules/players/players.js";
import player from "@/store/modules/players/player.js";

import notification from "@/store/modules/notification.js";


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
