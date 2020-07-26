function genIdModal(name, id) {
    var MName = '';
    var next = 0;
    while (next == 0) {
        var countM = $(name + id).length;
        if (countM > 0) {
            id = id + 10;
        } else {
            MName = name + id;
            next = 1;
        }
    }
    return MName;
}

function initModal() {
    var c_modals = $('.modal').length;
    var index = 2050 + (c_modals * 10);
    var conf = {
        'index': index,
        'size': 'md',
        'type': '',
        'target': '',
        'title': '',
        'cont': '',
        'btnt_c': true,
        'btnf_c': true,
        'btnf_crud': [0, 0, 0, 0],
        'ref': false,
        'backdrop': 'static',
        'keyboard': false,
        'focus': true,
        'show': true,
        'sound': false,
        'hideall': true,
        'hidder': false,
        'rem_error': false,
        'nav': false
    };
    return conf;
}

function genModal(conf) {
    if (conf['hideall']) {
        window.hideAllModal().then(function(result) {
            return window.deployModal(conf);
        });
    } else {
        return window.deployModal(conf);
    }
}


function deployModal(conf) {



    var index = conf['index'];
    var size = conf['size'];
    var type = conf['type'];
    var target = conf['target'];
    var title = conf['title'];
    var cont = conf['cont'];
    var btnt_c = conf['btnt_c'];
    var btnf_c = conf['btnf_c'];
    var btnf_crud = conf['btnf_crud'];
    var ref = conf['ref'];
    var backdrop = conf['backdrop'];
    var keyboard = conf['keyboard'];
    var focus = conf['focus'];
    var show = conf['show'];
    var sound = conf['sound'];
    var hideall = conf['hideall'];
    var hidder = conf['hidder'];
    var rem_error = conf['rem_error'];
    var rem_other = conf['rem_other'] || false;
    var nav = conf['nav'];
    var send_btn = false;
    if (target !== '') {
        id = target;
    } else {
        id = index;
    }
    switch (type) {
        case 1:
            //Cross System Error
            $("[id^='CSEM-']").remove();
            id = window.genIdModal('CSEM-', id);
            title = (title !== '' ? title : 'Cross System Error Message.');
            bg_header_c = 'bg-danger';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
        case 2:
            //System error
            $("[id^='SEM-']").remove();
            id = window.genIdModal('SEM-', id);
            title = (title !== '' ? title : 'System Error Message.');
            bg_header_c = 'bg-danger';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
        case 3:
            //User Error
            $("[id^='UEM-']").remove();
            id = window.genIdModal('UEM-', id);
            title = (title !== '' ? title : 'Error Message (User / Form / Process).');
            bg_header_c = 'bg-warning';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
        case 4:
            //Alert Control Error
            $("[id^='ACM-']").remove();
            id = window.genIdModal('ACM-', id);
            title = (title !== '' ? title : 'User Alert Message.');
            bg_header_c = 'bg-warning';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
        case 5:
            //Succefull Modal
            $("[id^='SM-']").remove();
            id = window.genIdModal('SM-', id);
            title = (title !== '' ? title : 'Successful execution.');
            bg_header_c = 'bg-success';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
        case 6:
            //Help Modal
            $("[id^='HM-']").remove();
            id = window.genIdModal('HM-', id);
            title = (title !== '' ? title : 'System Help.');
            bg_header_c = 'bg-info';
            bg_footer_c = 'bg-info';
            bg_btn_c = 'btn-light';
            break;
        default:
            //Other Modal
            $("[id^='OM-']").remove();
            id = window.genIdModal('OM-', id);
            title = (title !== '' ? title : 'Unknown Message.');
            bg_header_c = 'bg-light';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            break;
    }
    /*Variables de Texto*/
    //console.log(window.SYS.dic);
    //console.log(window.SYS.dic[1].indice);



    /*
    close
    send
    report



    Approve
    Save
    Delete
    Search


    var btnt_cTXT = '';
    if (btnt_c) {
        btnt_cTXT = '<button type="button" class="close" data-dismiss="modal"><i class="fas fa-window-close ' + bg_btn_c + '"></i><span class="sr-only">Cerrar</span></button>';
    }

    var btnf_cTXT = '';
    if (btnf_c) {
        btnf_cTXT = '<button type="button" class="btn btn-outline ' + bg_btn_c + '" data-dismiss="modal">Close</button>';
    }
    send_btnTxt = '';
    if (send_btn == true) {
        send_btnTxt = '<button type="button" class="btn btn-outline ' + bg_btn_c + '" name="p-report" data-target="' + id + '" >Reportar a IT</button>';
    }








    var btnf_crudTXT = '';
    if (typeof btnf_crud !== 'undefined' && btnf_crud.length > 0) {
        btnf_crudTXT = '<button type="button" class="btn ' + bg_btn_c + '">Pend.</button>' +
            '<button type="button" class="btn btn-outline ' + bg_btn_c + '">Pend.</button>' +
            '<button type="button" class="btn btn-outline ' + bg_btn_c + '">Pend.</button>' +
            '<button type="button" class="btn btn-outline ' + bg_btn_c + '">Pend.</button>' +
            '<button type="button" class="btn btn-outline ' + bg_btn_c + '">Pend.</button>' +
            '<button type="button" class="btn btn-outline ' + bg_btn_c + '">Pend.</button>';
    }


    if (conf['title'] != '') {
        title = conf['title'];
    }
    if (ref) {
        cont = cont + '<br><br><b>El Sistema debe Refrescar la pantalla; al momento se Cerrar este mensaje.</b>';
    }
    if (size != '') {
        size = 'modal-' + size;
    }
    console.log(target);
    console.log(id);
    var html =
        '<div id="' + id + '" class="modal inmodal fade m-c-able" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false" style="display:none; z-index: ' + zIndex + ';">' +
        '<div class="modal-dialog ' + size + '">' +
        '<div class="modal-content animated bounceInRight">' +
        '<div class="modal-header ' + bg_header_c + '">' +
        btnt_cTXT +
        '<h4 class="modal-title">' + title + '</h4>' +
        '</div>' +
        '<div class="modal-body">' + cont + '</div>' +
        '<div class="modal-footer ' + bg_footer_c + '" data-html2canvas-ignore="true">' +
        btnf_crudTXT + send_btnTxt + btnf_cTXT +
        '</div>' +
        '</div></div></div>';
    $("#Modal-js").append(html);
    var modal = {
        'target': '#' + id,
        'backdrop': conf['backdrop'],
        'keyboard': conf['keyboard'],
        'focus': conf['focus'],
        'show': conf['show']
    };
    window.ShowModal(modal).then(function(result) {
        $(document).off('focusin.modal');
        if (conf['sound'] == true) {
            $.playSound(window.SIS.VoiceIA[e['voice']]);
        }
        if (conf['remError']) {
            window.SIS['Error'] = false;
        }
        $(document).on('hidden.bs.modal', '#' + id, function(e) {
            if (nav) {
                window.AutoNavForm();
            }
            if (ref) {
                window.WinrefreshAuto();
            }
        });
    });
    window.ReloadElementJS();
    */
}

function hideAllModal() {
    return new Promise(function(resolve, reject) {
        var count = $(".modal.show").length;
        if (0 != count) {
            $('.modal.show').modal('hide');
            count = $(".modal.show").length;
            if (0 == count) {
                resolve(true);
            } else {
                window.hideAllModal().then(function(result) {
                    resolve(true);
                });
            }
        } else {
            resolve(true);
        }
    });
}