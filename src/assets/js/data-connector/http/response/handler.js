import { json, blob, formData, text} from "@/assets/js/data-connector/http/response/types";
import {includes} from "core-js/internals/array-includes";

function responseHandler(res) {
    if (!res.ok) return response(res).then(err => {throw err});
    return response(res);
}

async function response(res) {
    const type = res.headers.get('content-type');

    if (type?.includes('application/json')) return json(res);
    else if (type?.includes('application/octet-stream')) return blob(res);
    else if (type?.includes('application/pdf')) return blob(res);
    else if (type?.includes('application/zip')) return blob(res);
    else if (type?.includes('application/png')) return blob(res);
    else if (type?.includes('application/jpg')) return blob(res);
    else if (type?.includes('application/jpeg')) return blob(res);
    else if (type?.includes('multipart/form-data')) return formData(res);
    else if (type?.includes('application/x-www-form-urlencoded')) return formData(res);
    else if (type?.includes('text/plain')) return text(res);
    else if (type?.includes('text/html')) return text(res);
    else if (type?.includes('text/xml')) return text(res);
    else if (type?.includes('text/csv')) return text(res);
    else if (type?.includes('text/css')) return text(res);
    else if (type?.includes('text/javascript')) return text(res);
    else return Error('Unknown response type');
}

export { responseHandler }
