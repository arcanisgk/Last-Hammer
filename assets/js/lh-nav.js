function ManagerMenu() {
    return new Promise(function(resolve, reject) {
        console.log('%cLoaded Navigation Handler ----> Started.', window.CONST.c_green);
        resolve(true);
    })
}

function ManagerForm() {
    return new Promise(function(resolve, reject) {
        console.log('%cLoaded Forms Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}