import { createTranslator } from "@/lang/translator";

import auth_en from "@/lang/translations/en/auth";
import app_en from "@/lang/translations/en/app";
import auth_nl from "@/lang/translations/nl/auth";
import app_nl from "@/lang/translations/nl/app";


const translator = createTranslator({
    "en": {
        auth: auth_en,
        app: app_en
    },
    "nl": {
        auth: auth_nl,
        app: app_nl
    }
});

export default translator;