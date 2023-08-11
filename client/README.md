# Client
Author: Thibo Verbeerst

Client is developed on a 100% display resolution of 1920x1080 with a 100% zoom level.  
The browser used is Firefox.  
It is not tested/optimized for other browsers or resolutions.  

The client code is build with the template code of the Mars project.  
Note: The Mars client was 100% build by me...

## Get Started

### Install

```bash
npm install
```

### Run

```bash
npm run serve
```

### Build

```bash
npm run build
```


### Languages
- [English](#english)
- [Dutch](#dutch)

**IMPORTANT!**  
Client text is fully translated, but the API is not.
> This means that the API will return English text when dutch is requested.  
> This is because I don't have the time to translate the API.  

Except for the player Scottie Scheffler, he is fully translated. (en & nl)

## Dependencies
- [Vue](https://vuejs.org/)
- [Vue Router](https://router.vuejs.org/)
- [Vuex](https://vuex.vuejs.org/)

## Translator Module
The translator module is a custom module that I made for this project.  
It is a simple module that can be used to translate text in the client.  
Module can be found in: `src/lang/` directory.

The language files are located in the `src/lang/<lang>/` directory.
The language files should have the same properties for each language.

### Usage (example)

#### Translation files
`src/lang/en/app.js`
```js
export default {
  "hello": "Hello",
  "world": "World"
}
```
`src/lang/nl/app.js`
```js
export default {
  "hello": "Hallo",
  "world": "Wereld"
}
```

#### Register Translation Module
`src/lang/index.js`
```js
import { createTranslator } from "@/lang/translator";

import app_en from "@/lang/translations/en/app";
import app_nl from "@/lang/translations/nl/app";


const translator = createTranslator({
    "en": {
        app: app_en // key must be the same as for the other languages
    },
    "nl": {
        app: app_nl // key must be the same as for the other languages
    }
});

export default translator;
```

#### Use Translation Module
The translation module is registered globally in the Vue instance.  
Can be accessed with `this.$translator` in a Vue component.  
This is done in `src/main.js`, by installing the module as plugin.
````js
import translator from "./lang";

app.use({
    install: (app) => {
        app.config.globalProperties.$translator = translator;
    }
});
````

*Methods*:
- language(): `this.$translator.language()`   
  Returns the current language.
- languages(): `this.$translator.languages()`  
  Returns all available languages. Compares available server and client languages.
- translate(key: string): `this.$translator.translate("app.hello")`  
  Returns the translation of the given key.  
  If the key is not found, undefined will be returned.


*Translation Module in Component:*  
`src/components/HelloWorld.vue`
```vue
<template>
  <div>
    <h1>{{ this.$translator.translate("app.hello") }}</h1>
  </div>
</template>
```
## Router
Vue Router is used for routing in the client.  
The routes are defined in `src/router/routes.js`.

#### Router Guards
The router guard is defined in `src/router/guards.js` and is executed for every route navigation.  
This guard is used to check if the user is logged in or has permission to access route.  
The guard is registered in `src/router/index.js`.
````js
import { routeGuard } from "./guard";

router.beforeEach(routeGuard);
````

The guard uses the meta data of the route to check if the route is protected and what permissions are required.  
````js
{
    path: '/players/create',
        name: 'Create Player',
        components: {
        App: CreatePlayerView
    },
    meta: {
        protected: true,
        permissions: [
            'create-players'
        ]
    }
}
````

If the route is protected, the guard will check if the user is logged in. By checking if the token is valid.
This is done with the `/auth/vaildate` endpoint of the API.
For every protected route, the guard will check if the user has the required permissions.
