import { createStore } from "vuex";

// modules
import authentication from "@/store/modules/auth/authentication";
import countries from "@/store/modules/countries/countries";

import notification from "@/store/modules/notification";


const store = createStore({
    modules: {
        authentication,
        countries,
        notification
    }
});

export default store;
