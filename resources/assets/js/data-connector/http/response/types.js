function json(response) {
    return response.json().then((data) => data) ;
}

function text(response) {
    return response.text().then((data) => data) ;
}

function blob(response) {
    return response.blob().then((data) => data) ;
}

function formData(response) {
    return response.formData().then((data) => data) ;
}

export {
    json,
    text,
    blob,
    formData
}
