function ManagerEvent() {
    return new Promise(function(resolve, reject) {
        console.log('%cLoaded Event Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}