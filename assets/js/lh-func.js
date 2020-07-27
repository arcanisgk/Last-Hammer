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
        'sound_id': '',
        'hideall': true,
        'hidder': false,
        'rem_error': false,
        'nav': false
    };
    return conf;
}

function genModal(conf) {
    if (conf['hideall']) {
        window.hideAllModal().then((result) => {
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
    var sound_id = conf['sound_id'];
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
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true) {
                window.playSound('error');
            }
            break;
        case 2:
            //System error
            $("[id^='SEM-']").remove();
            id = window.genIdModal('SEM-', id);
            title = (title !== '' ? title : 'System Error Message.');
            bg_header_c = 'bg-danger';
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true) {
                window.playSound('error');
            }
            break;
        case 3:
            //User Error
            $("[id^='UEM-']").remove();
            id = window.genIdModal('UEM-', id);
            title = (title !== '' ? title : 'Error Message (User / Form / Process).');
            bg_header_c = 'bg-warning';
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true) {
                window.playSound('error');
            }
            break;
        case 4:
            //Alert Control Error
            $("[id^='ACM-']").remove();
            id = window.genIdModal('ACM-', id);
            title = (title !== '' ? title : 'User Alert Message.');
            bg_header_c = 'bg-warning';
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true) {
                window.playSound('error');
            }
            break;
        case 5:
            //Succefull Modal
            $("[id^='SM-']").remove();
            id = window.genIdModal('SM-', id);
            title = (title !== '' ? title : 'Successful execution.');
            bg_header_c = 'bg-success';
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true) {
                window.playSound('correct');
            }
            break;
        case 6:
            //Help Modal
            $("[id^='HM-']").remove();
            id = window.genIdModal('HM-', id);
            title = (title !== '' ? title : 'System Help.');
            bg_header_c = 'bg-info';
            txt_header_c = 'text-white';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-light';
            if (sound == true && sound_id !== '') {
                window.playSound(sound_id);
            }
            break;
        default:
            //Other Modal
            $("[id^='OM-']").remove();
            id = window.genIdModal('OM-', id);
            title = (title !== '' ? title : 'Unknown Message.');
            bg_header_c = 'bg-light';
            txt_header_c = 'text-danger';
            bg_footer_c = 'bg-light';
            bg_btn_c = 'btn-danger';
            send_btn = true;
            if (sound == true && sound_id !== '') {
                window.playSound(sound_id);
            }
            break;
    }
    var btnt_cTXT = '';
    if (btnt_c) {
        //btnt_cTXT = '<button type="button" class="close" data-dismiss="modal"><i class="fas fa-window-close ' + bg_btn_c + '"></i><span class="sr-only">' + window.SYS.dic.close[window.SYS.lang] + '</span></button>';
        btnt_cTXT = '<button name="modal-close" data-target="' + id + '" type="button" class="close ' + bg_btn_c + '" aria-label="' + window.SYS.dic.close[window.SYS.lang] + '"><span aria-hidden="true">&times;</span></button>';
    }
    var btnf_cTXT = '';
    if (btnf_c) {
        btnf_cTXT = '<button name="modal-close" data-target="' + id + '" type="button" class="btn ' + bg_btn_c + '">' + window.SYS.dic.close[window.SYS.lang] + '</button>';
    }
    send_btnTxt = '';
    if (send_btn == true) {
        send_btnTxt = '<button type="button" class="btn ' + bg_btn_c + '" name="p-report" data-target="' + id + '" >' + window.SYS.dic.report[window.SYS.lang] + '</button>';
    }
    var btnf_crudTXT = '';
    if (typeof btnf_crud !== 'undefined' && Array.isArray(btnf_crud) && btnf_crud.length > 0) {
        if (typeof btnf_crud[0] !== 'undefined' && btnf_crud[0] == 1) {
            btnf_crudTXT += '<button type="button" class="btn btn-outline-success" name="e-agree">' + window.SYS.dic.Agree[window.SYS.lang] + '</button>';
        }
        if (typeof btnf_crud[1] !== 'undefined' && btnf_crud[1] == 1) {
            btnf_crudTXT += '<button type="button" class="btn btn-outline-info" name="e-save">' + window.SYS.dic.Save[window.SYS.lang] + '</button>';
        }
        if (typeof btnf_crud[2] !== 'undefined' && btnf_crud[2] == 1) {
            btnf_crudTXT += '<button type="button" class="btn btn-outline-danger" name="e-delete">' + window.SYS.dic.Delete[window.SYS.lang] + '</button>';
        }
        if (typeof btnf_crud[3] !== 'undefined' && btnf_crud[3] == 1) {
            btnf_crudTXT += '<div class="input-group float-lg-left col"><input type="text" class="form-control" name="input_search" placeholder="' + window.SYS.dic.SearchInput[window.SYS.lang] + '" value=""><span class="input-group-append"><button type="button" class="btn btn-outline-success" name="e-consult"><b>' + window.SYS.dic.Search[window.SYS.lang] + '</b> <i class="fas fa-search"></i></button></span></div>';
        }
    }
    if (ref) {
        cont = cont + '<br><br><b>' + window.SYS.dic.Refresh[window.SYS.lang] + '</b>';
    }
    if (size != '') {
        size = 'modal-' + size;
    }
    var html =
        '<div id="' + id + '" class="modal modal-dialog-centered fade" id="staticBackdrop" data-backdrop="false" tabindex="-1" role="dialog" aria-hidden="true" style="display:none; z-index: ' + index + ';">' +
        '<div class="modal-dialog ' + size + '">' +
        '<div class="modal-content animated bounceInRight">' +
        '<div class="modal-header ' + bg_header_c + '">' +
        '<h5 class="modal-title ' + txt_header_c + '">' + title + '</h5>' + btnt_cTXT +
        '</div>' +
        '<div class="modal-body">' + cont + '</div>' +
        '<div class="modal-footer ' + bg_footer_c + '" data-html2canvas-ignore="true">' +
        btnf_crudTXT + send_btnTxt + btnf_cTXT +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    $("#modal-js").append(html);
    var modal = {
        'target': '#' + id,
        'backdrop': backdrop,
        'keyboard': keyboard,
        'focus': focus,
        'show': show,
        'index': index
    };
    window.showModal(modal).then((result) => {
        $(document).off('focusin.modal');
        if (rem_error) {
            window.SIS.error = false;
        }
        $(document).on('hidden.bs.modal', '#' + id, (e) => {
            if (nav) {
                //window.AutoNavForm();
            }
            if (ref) {
                window.winRefresh();
            }
        });
    });
    $(document).off('click.m', 'button[name="modal-close"]');
    $(document).unbind('click.m', 'button[name="modal-close"]');
    $(document).on('click.m', 'button[name="modal-close"]', (e) => {
        const element = document.querySelector('#' + e.target.dataset.target + ' .modal-content');
        element.classList.add('animated', 'bounceOutLeft');
        element.addEventListener('animationend', () => {
            $(modal['target']).modal("hide");
        });
    });
    //window.ReloadElementJS();
}

function showModal(modal) {
    return new Promise((resolve, reject) => {
        $(document).on('shown.bs.modal', modal['target'], (e) => {
            resolve(true);
        });
        $(modal['target']).modal({
            backdrop: modal['backdrop'],
            keyboard: modal['keyboard'],
            focus: modal['focus'],
            show: modal['show']
        });
        if (modal["index"] != undefined) {
            zIndex = modal["index"] + ' !important';
            $(modal['target']).css({
                'z-index': zIndex
            });
            $(modal['target']).attr('style', 'z-index: ' + zIndex);
        }
    })
}

function hideAllModal() {
    return new Promise((resolve, reject) => {
        var count = $(".modal.show").length;
        if (0 != count) {
            const element = document.querySelector('.modal-content');
            element.classList.add('animated', 'bounceOutLeft');
            element.addEventListener('animationend', () => {
                $('.modal.show').modal('hide');
                count = $(".modal.show").length;
                if (0 == count) {
                    resolve(true);
                } else {
                    window.hideAllModal().then((result) => {
                        resolve(true);
                    });
                }
            });
        } else {
            resolve(true);
        }
    });
}

function playSound(ref) {
    if (window.SYS.user_interaction == true) {
        document.getElementById(ref).play();
    }
}

function winRefresh() {
    var canRefresh = window.SYS.options.refresh;
    if (canRefresh) {
        window.location.reload(true);
    } else {
        console.log('%cThe system tried a window refresh, but it is disabled in "lh-var.js"', 'color: red');
    }
}