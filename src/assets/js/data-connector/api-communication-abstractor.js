import { loadFromStorage } from "@/assets/js/data-connector/local-storage-abstractor";
import { API } from '@/main.js';
import store from '@/store/index.js';

function get(uri, successHandler = logJson, failureHandler = errorHandler) {
    const options = constructOptions('get');
    const request = new Request(API + uri, options);

    return call(request, successHandler, failureHandler);
}

function post(uri, body, successHandler = logJson, failureHandler = errorHandler) {
    const options = constructOptions('POST', body);
    const request = new Request(API + uri, options);

    return call(request, successHandler, failureHandler);
}

function put(uri, body, successHandler = logJson, failureHandler = errorHandler) {
    const options = constructOptions('PUT', body);
    const request = new Request(API + uri, options);

    return call(request, successHandler, failureHandler);
}

function remove(uri, successHandler = logJson, failureHandler = errorHandler) {
    const options = constructOptions('DELETE');
    const request = new Request(API + uri, options);

    return call(request, successHandler, failureHandler);
}

function constructOptions(httpVerb, requestBody){
    const options= {
        method: httpVerb,
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        }
    };

    const token = loadFromStorage('token');
    if(token !== null) {
        options.headers["Authorization"] = "Bearer " + token;
    }

    options.body = JSON.stringify(requestBody);
    return options;
}


function logJson(json) {
    console.log(json);
}

function errorHandler(response) {
    try {
        response.json().then(error => {
            errorRoute(error)
            errorNotification(error);
        });
    }
    catch (e) {

    }
}

function errorRoute(error) {
    if (error.failure === 401) {
        store.dispatch('logout');
    }
}

function errorNotification(error) {
    if (typeof error.cause === "string") {
        store.dispatch('createNotification', {content: error.cause, type: `error`});
    } else if (typeof error.cause === "object") {
        for (const cause in error.cause) {
            if (!Array.isArray(error.cause[cause])) {
                store.dispatch('createNotification', {content: error.cause[cause], type: `error`});
                continue;
            }
            for (const message of error.cause[cause]) {
                store.dispatch('createNotification', {content: message, type: `error`});
            }
        }
    }
}

function call(request, successHandler, errorHandler) {
    return fetch(request)
        .then(response => {
            const type =response.headers.get('content-type');
            if (!response.ok) {
                throw response;
            }
            if(type?.includes('application/json')) {
                return response.json();
            }
            return null;
        })
        .then(successHandler)
        .catch(errorHandler);
}

export { get, post, put, remove };
