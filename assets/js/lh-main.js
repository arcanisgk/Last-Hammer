document.addEventListener("DOMContentLoaded", (e) => {
    document.getElementById("email").focus();
    window.initLoading();
    window.initSystemVar().then((result) => {
        window.getServerStatus();
        /* test of modal */
        $(document).on('click.m', "#p-login", (e) => {
            var cerror = '<br><span align="center" class="blink text-danger"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br><b>The connection to the Server has been lost: </b> <br> <br> The System will not allow you to work until the connection with the Server is reestablished. <br> <br> You can verify your NETWORK connection. <br> <br> We recommend: <br> 1. If you have changed your network, close this alert. <br> 2. If the Alert Continues to Exit, Close the System Completely and log in back. <br> 3. If this Alert persists, contact Technical Support to Verify your Network and Equipment. <br> 4. If you have any problem in the System, refresh the screen to reload environment.<br><br><span align="center" class="blink text-danger"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br>';
            var conf = window.initModal();
            conf['type'] = 7;
            conf['size'] = 'lg';
            conf['title'] = 'Server Connection.';
            conf['cont'] = cerror;
            conf['ref'] = true;
            conf['sound'] = true;
            conf['sound_id'] = 'correct';
            conf['remError'] = true;
            window.genModal(conf);
        });
    });
    //window.AutoShow();



    /*

    window.ManagerServerRQ();
    window.ManagerPlugin().then(function(result) {
        window.ManagerFunction().then(function(result) {
            window.ManagerMenu().then(function(result) {
                window.ManagerForm().then(function(result) {
                    window.ManagerEvent().then(function(result) {
                        window.SisLoaded();
                    })
                });
            });
        });
    });
    */
});

function initLoading() {
    console.log('%cWelcome, if you see this message, it is located in the Browser Commands console.', window.CONST.c_melon);
}

function SisLoaded() {
    console.log('%cSystem effectively initialized up to this Point.', 'color: ' + window.CONST.c_melon);
}

function AutoShow() {
    /*
    $(".modal").each(function() {
        var show = $(this).attr('aria-hidden');
        var ref = $(this).attr('ref-force');
        if (show == 'false') {
            $(this).modal('show');
            if (ref == 'true') {
                $(this).on('hidden.bs.modal', function(e) {
                    window.WinrefreshAuto();
                })
            }
        }
    });
    */
}

function getServerStatus() {
    setInterval((e) => {
        setTimeout((e) => {}, window.SYS.ser_conn['serv_time_b']);
        fetch('configs/scralone/signal.php', {
            method: 'GET'
        }).then((response) => {
            if (response.ok) {
                response.text().then((datos) => {
                    window.removeConnectivityModalError();
                });
            } else {
                window.getConnectivityModalError();
            }
        }).catch((error) => {
            window.getConnectivityModalError();
        });
    }, window.SYS.ser_conn['serv_time_a']);
}

function getConnectivityModalError() {
    if (window.SYS.ser_conn['serv_chk'] === true || $(".modal.show").length == 0) {
        window.SYS.ser_conn['serv_chk'] = false;
        window.SYS.ser_conn['serv_sta'] = true;
        var cerror = '<br><span align="center" class="blink text-danger"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br><b>The connection to the Server has been lost: </b> <br> <br> The System will not allow you to work until the connection with the Server is reestablished. <br> <br> You can verify your NETWORK connection. <br> <br> We recommend: <br> 1. If you have changed your network, close this alert. <br> 2. If the Alert Continues to Exit, Close the System Completely and log in back. <br> 3. If this Alert persists, contact Technical Support to Verify your Network and Equipment. <br> 4. If you have any problem in the System, refresh the screen to reload environment.<br><br><span align="center" class="blink text-danger"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br>';
        var conf = window.initModal();
        conf['type'] = 2;
        conf['size'] = 'lg';
        conf['title'] = 'Server Connection.';
        conf['cont'] = cerror;
        conf['ref'] = true;
        conf['sound'] = true;
        conf['remError'] = true;
        window.genModal(conf);
    }
}

function removeConnectivityModalError() {
    window.SYS.ser_conn['serv_chk'] = true;
    if (window.SYS.ser_conn['serv_chk'] == true && window.SYS.ser_conn['serv_sta'] == true) {
        window.hideAllModal();
    }
}