function ManagerPlugin() {
    return new Promise(function(resolve, reject) {
        console.log('%cLoaded Plugin Handler --------> Started.', window.CONST.c_green);
        resolve(true);
    })
}