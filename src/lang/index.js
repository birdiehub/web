import { createTranslator } from "@/lang/translator";

import global_en from "@/lang/translations/en/global";
import global_nl from "@/lang/translations/nl/global";
import auth_en from "@/lang/translations/en/auth";
import app_en from "@/lang/translations/en/app";
import auth_nl from "@/lang/translations/nl/auth";
import app_nl from "@/lang/translations/nl/app";


const translator = createTranslator({
    "en": {
        global: global_en,
        auth: auth_en,
        app: app_en
    },
    "nl": {
        global: global_nl,
        auth: auth_nl,
        app: app_nl
    }
});

export default translator;