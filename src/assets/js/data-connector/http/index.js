import {responseHandler} from "@/assets/js/data-connector/http/response/handler";
import {loadFromStorage} from "@/assets/js/data-connector/local-storage/local-storage-abstractor";

import { API } from '@/main.js';
import { errorHandler } from "@/assets/js/data-connector/http/handlers/error";
import { successHandler} from "@/assets/js/data-connector/http/handlers/success";


function get(uri, success = successHandler, error = errorHandler) {
    const options = constructOptions('GET');
    const request = new Request(API + uri, options);

    return call(request, success, error);
}

function post(uri, body, success = successHandler, error = errorHandler) {
    const options = constructOptions('POST', body);
    const request = new Request(API + uri, options);

    return call(request, success, error);
}

function put(uri, body, success = successHandler, error = errorHandler) {
    const options = constructOptions('PUT', body);
    const request = new Request(API + uri, options);

    return call(request, success, error);
}

function remove(uri, success = successHandler, error = errorHandler) {
    const options = constructOptions('DELETE');
    const request = new Request(API + uri, options);

    return call(request, success, error);
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

function call(request, successHandler, errorHandler) {
    return fetch(request)
        .then(responseHandler)
        .then(successHandler)
        .catch(errorHandler);
}


export { get, post, put, remove };
