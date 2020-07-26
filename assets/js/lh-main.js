document.addEventListener("DOMContentLoaded", function() {
    window.initLoading();
    window.initSystemVar().then(function(result) {
        window.getServerStatus();



        var conf = window.initModal();
        cerror = 'Prueba modal';
        conf['type'] = 2;
        conf['size'] = 'lg';
        conf['title'] = 'Conexión al Servidor.';
        conf['cont'] = cerror;
        conf['ref'] = true;
        conf['remError'] = true;
        window.genModal(conf);



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
    setInterval(function() {
        setTimeout(function() {}, window.SYS.ser_conn['serv_time_b']);
        $.ajax({
            type: "POST",
            url: "configs/scralone/signal.php",
            error: function(xhr, status, error) {

                console.log('error');


                if (window.SYS.ser_conn['serv_chk'] === true) {
                    window.SYS.ser_conn['serv_chk'] = false;
                    window.SYS.ser_conn['serv_sta'] = true;



                    var cerror = '<br><span align="center" class="blink"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br><b>Se ha perdido la conexión al Servidor:</b><br><br> El Sistema no le permitirá trabajar hasta restablecer la conexión con el Servidor. <br><br>Usted puede verificar su conexión de RED.<br><br>Le recomendamos:<br> 1. Si ha Cambiado de Red Que Cierre esta Alerta.<br>2. Si Continua Saliendo la Alerta Cierre el Sistema Completamente y vuelva a entrar. <br>3. De Persistir esta Alerta Contacte con Soporte Técnico, para que Verifique su Red y Equipo.<br>4. Si presenta algún inconveniente en el Sistema, refresque la pantalla para cargar nuevamente las variables.<br><br><span align="center" class="blink_me"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br>';
                    var conf = window.InitModal();

                    console.log(conf);


                    /*
                    conf['type'] = 0;
                    conf['size'] = 'lg';
                    conf['title'] = 'Conexión al Servidor.';
                    conf['cont'] = cerror;
                    conf['ref'] = true;
                    conf['remError'] = true;
                    window.ModalGen(conf);
                    */



                }



            },
            success: function(response) {
                window.SYS.ser_conn['serv_chk'] = true;
                if (window.SYS.ser_conn['serv_chk'] == true && window.SYS.ser_conn['serv_sta'] == true) {
                    window.hideAllModal();
                }
            },
        });
    }, window.SYS.ser_conn['serv_time_a']);
}