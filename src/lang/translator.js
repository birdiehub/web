import {loadFromStorage} from "@/assets/js/data-connector/local-storage-abstractor";

class Translator {
    constructor(languages){
        this.languages = languages;
    }
    translate(key){
        return this._getProperty(this._language(), key.split('.'));
    }

    _language() {
        const lang = loadFromStorage('language');
        return this.languages[lang];
    }

    _getProperty(obj, keys) {
        const key = keys.shift();

        if (typeof obj !== 'object' || obj === null || !obj.hasOwnProperty(key)) return undefined;

        if (keys.length === 0) return obj[key];

        return this._getProperty(obj[key], keys);
    }
}

export function createTranslator(languages) {
    return new Translator(languages);
}