import { createTranslator } from "@/lang/translator";

import auth_en from "@/lang/translations/en/auth";
import app_en from "@/lang/translations/en/app";


const translator = createTranslator({
    "en": {
        auth: auth_en,
        app: app_en
    }
});

export default {
    install: (app) => {
        app.config.globalProperties.$translator = translator;
    }
};