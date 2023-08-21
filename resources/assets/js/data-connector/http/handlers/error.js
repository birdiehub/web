import store from "@/store";

// error should be an object with the following structure:
// {
//     failure: <http-code>,
//     cause: {
//         username: ["This field is required."],
//         password: ["This field is required."]
//     }
// }
// or
// {
//     failure: <http-code>,
//     cause: "This field is required."
// }


export function errorHandler(error) {
    errorRouter(error)
    errorNotification(error);
}

function errorRouter(error) {
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
