function ManagerEvent() {
    return new Promise((resolve, reject) => {
        window.eInputChange();
        window.eCRUD();
        window.ShowPass();
        console.log('%cLoaded Event Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}

function reloadManagerEvent() {
    return new Promise((resolve, reject) => {
        window.eInputChange();
        window.eCRUD();
        window.ShowPass();
        console.log('%cRe-Loaded Event Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}

/* Event Input Detecting Changes*/
function eInputChange() {
    $(document).off('click.ic', ':input');
    $(document).unbind('click.ic', ':input');
    $(document).on('click.ic', ':input', function(e) {
        let inputs = window.SYS.input_edited;
        let c_name = $(e.currentTarget).attr('name');
        if (typeof c_name !== 'undefined') {
            c_name = 'old-' + c_name;
            if (!(c_name in inputs)) {
                window.SYS.input_edited[c_name] = ($(e.currentTarget).val() == '') ? 'Campo Vacio' : $(e.currentTarget).val();
            }
        }
    });
    $(document).off('change.ic', ':input');
    $(document).unbind('change.ic', ':input');
    $(document).on('change.ic', ':input', function(e) {
        let inputs = window.SYS.input_edited;
        let c_val = ($(e.currentTarget).val() == '') ? 'Campo Vacio' : $(e.currentTarget).val();
        let c_name = $(e.currentTarget).attr('name');
        if (typeof inputs['old-' + c_name] !== 'undefined') {
            window.SYS.input_edited['new-' + c_name] = c_val;
        }
    });
}

function getInputChange() {
    var inputs = window.SYS.input_edited;
    var render = '';
    Object.entries(inputs).forEach(function([key, value], index) {
        if (key.indexOf("old-") !== -1) {
            var input_name = key.replace('old-', '');
            var data_old = inputs['old-' + input_name];
            var data_new = inputs['new-' + input_name];
            if (data_old == data_new) {
                delete inputs['old-' + input_name];
                delete inputs['new-' + input_name];
            } else {
                render += 'old-' + input_name + ' = ' + data_old + '\n';
                render += 'new-' + input_name + ' = ' + data_new + '\n';
            }
        }
    });
    return render;
}

/* Event of CRUD */

function eCRUD() {
    $('button[name^="e-"],button[name^="me-"],a[name^="e-"],a[name^="me-"]').each(function() {
        $(this).off('click.e');
        $(this).unbind('click.e');
    });
    $(document).on('click.e', 'button[name^="e-"],button[name^="me-"],a[name^="e-"],a[name^="me-"]', function(e) {
        window.stopEvent(e);
        var _this = $(this);
        var _btn_name = $(e.currentTarget).attr('name');
        window.addDisable(_this);
        window.waitModal().then((result) => {
            try {
                let form = '';
                let form_event = '';
                form = _this.attr('data-target');
                if (typeof form !== 'undefined') {
                    form_event = form;
                } else {
                    form_event = $("body form").first().attr('name');
                }
                let btn_arr = _btn_name.split('-');
                let forn_arr = form_event.split('-');
                let e_post = {
                    process: _btn_name,
                    form: form_event,
                    event: _this
                };
                let if_error = window.checkRequiredField(form_event, _btn_name);
                if (if_error.status == true) {
                    error = window.SYS.dic.ierror1[window.SYS.lang] + '<br>' +
                        window.SYS.dic.ierror2[window.SYS.lang] + ' <b>' + if_error.count + '</b><br>' +
                        window.SYS.dic.ierror3[window.SYS.lang] + '<br><b>' + if_error.element + '</b>';
                    throw (new Error(error));
                } else {
                    switch (btn_arr[1]) {
                        case 'signin':
                            window.signin(e_post);
                            break;
                        case 'signout':
                            window.signout(e_post);
                            break;
                        case 'report':
                            let data_target = _this.attr('data-target');
                            e_post['datatarget'] = data_target;
                            window.bugrep(e_post);
                            break;
                        default:
                            window.toAjax(e_post);
                            break;
                    }
                }
                setTimeout(() => {
                    window.hideAllModal();
                }, 10000);
            } catch (error) {
                console.warn('%c' + error, window.CONST.c_red);
                window.ModalError(error);
                /*
                window.RemDisable($btnEvent);
                */
            }
        });
    });
}

function ModalError(error) {
    let cont = '<div>' + error + '</div>';
    let conf = window.initModal();
    conf['target'] = 'EventError';
    conf['type'] = 3;
    conf['size'] = 'lg';
    conf['btnf_c'] = false;
    conf['btnf_s'] = false;
    conf['cont'] = cont;
    window.genModal(conf);
}

/* Event of CRUD MODAL */

//d-sys-text
//d-####

//e- prefix event button

//s- prefix event search

//is- real- time search input
//bc- barcode scan

//fp- file plugin handler event
//fpd- file plugin (dropzone) handler event

function ShowPass() {
    $('[name="show-pass"]').off('click.e');
    $('[name="show-pass"]').unbind('click.e');
    $(document).on('click.e', '[name="show-pass"]', function(e) {
        window.stopEvent(e);
        let target_field = $(this).attr('data-target');
        let type = $(target_field).attr("type");
        let new_type = (type == "password" ? 'text' : 'password');
        let new_field = $("<input type='" + new_type + "' />").attr("id", $(target_field).attr("id")).attr("name", $(target_field).attr('name')).attr('class', $(target_field).attr('class')).val($(target_field).val());
        $(target_field).replaceWith(new_field);
    });
}


function checkRequiredField(form, btn = '') {
    let req = 0;
    let check = {
        status: false,
        count: 0,
        element: '',
    };
    if (btn.split('-')[1] != 'consult') {
        var elemArr = [];
        let cf_tables = ':input[type=search],input[name^="plg-calendar-"],';
        let cf_summerNot = '.custom-control-input,.note-input,textarea,';
        let cf_other = ':input[type=file], :input[type=button], :input[type=submit], :input[type=reset], :input[type=checkbox]:not(:checked)';
        $('[name="' + form + '"] *').not(cf_tables + cf_summerNot + cf_other).filter(':input').each(function(obj, v) {
            let name = 'no definido';
            if (typeof $(this) !== 'undefined' || $(this) !== null) {
                name = $(this).attr('name') || 'no definido';
            }
            if (name == 'no definido') {
                console.log($(this));
            } else {
                let type = this.type || this.tagName.toLowerCase();
                if ($(this).attr('required')) {
                    if (type == 'select-one' && $(this).val() == '') {
                        req++;
                        let elem = (typeof $(this).attr('data-i-name') !== 'undefined' ? $(this).attr('data-i-name') : name);
                        elemArr.push(elem);
                    } else if (type == 'checkbox' && !$(this).is(':checked')) {
                        req++;
                        let elem = (typeof $(this).attr('data-i-name') !== 'undefined' ? $(this).attr('data-i-name') : name);
                        elemArr.push(elem);
                    } else if (type == 'radio' && $('input:radio[name="' + name + '"]:checked').length == 0) {
                        req++;
                        let elem = (typeof $(this).attr('data-i-name') !== 'undefined' ? $(this).attr('data-i-name') : name);
                        elemArr.push(elem);
                    } else if (type == 'email' && $(this).val() === "") {
                        req++;
                        let elem = (typeof $(this).attr('data-i-name') !== 'undefined' ? $(this).attr('data-i-name') : name);
                        elemArr.push(elem);
                    } else if ($(this).val() === "" && $(this).attr('required')) {
                        req++;
                        let elem = (typeof $(this).attr('data-i-name') !== 'undefined' ? $(this).attr('data-i-name') : name);
                        elemArr.push(elem);
                    }
                }
            }
        });
        if (req > 0) {
            check.status = true;
            check.count = req;
            check.element = elemArr.join('<br>');
        }
    }
    return check;
}


/* custom Function */
function stopEvent(e) {
    e.stopPropagation();
    e.preventDefault();
    e.stopImmediatePropagation();
}


/*Event Function explicit*/

function signin(e_post) {
    let form = e_post.form;
    let proc = e_post.process;
    let json_obj = [];
    let form_data = new FormData();
    let inp = $(document).find('[name="idform"]').length;
    if (inp > 0) {
        $(document).find('[name="form"]').remove();
        $(document).find('[name="process"]').remove();
    }
    let input1 = $("<input>").attr("type", "hidden").attr("name", "form").val(form);
    let input2 = $("<input>").attr("type", "hidden").attr("name", "process").val(proc);
    $('[name="' + form + '"]').append($(input1));
    $('[name="' + form + '"]').append($(input2));
    let cf_tables = ':input[type=search],input[name^="plg-calendar-"],';
    let cf_summerNot = '.custom-control-input,.note-input,textarea,';
    let cf_other = ':input[type=file], :input[type=button], :input[type=submit], :input[type=reset], :input[type=checkbox]:not(:checked)';
    $('[name="' + form + '"] *').not(cf_tables + cf_summerNot + cf_other).filter(':input').each(function(obj, v) {
        let i_obj = {};
        var input = $(this);
        var inputname = 'no definido';
        if (typeof input !== 'undefined' || input !== null) {
            inputname = input.attr('name') || 'no definido';
        }
        if (inputname == 'no definido') {
            console.log(input);
        } else {
            if ((typeof inputname !== undefined || typeof inputname !== null) && inputname !== false) {
                inputname = inputname.replace(/-/g, '_');
                i_obj[inputname] = input.val();
                json_obj.push(i_obj);
            }
        }
    });
    let json_data = JSON.stringify(json_obj);
    form_data.append('json_data', json_data);
    window.sendAjax(form_data, e_post);
}

function signout() {
    console.log('signout', e_post);
}

function bugrep(e_post) {
    console.log('bugrep', e_post);
}

function toAjax(e_post) {
    console.log('toAjax', e_post);
}

function sendAjax(form_data, e_post) {
    let url = 'index.php';
    if (e_post.process == 'p-consult') {
        $('input[name="input_search"]').val('');
    }
    /*Prepare Request*/
    let request = {
        url: url,
        data: form_data,
        contentType: false,
        processData: false,
        type: 'POST',
        cache: false,
        error: function(xhr, status, error) {
            console.log('%cServer Request Error (Critical): ', window.CONST.c_red);
            console.warn('datos:', xhr, status, error);
            /*
            console.log('%cError de Petición al Servidor Critico ', 'color: red');
            console.warn('datos:', xhr, status, error);
            var conf = window.InitModal();
            conf['size'] = 'xl';
            conf['type'] = 0;
            conf['title'] = 'Error de Petición al Servidor.';
            conf['cont'] = error;
            conf['ref'] = true;
            window.ModalGen(conf);
            if (typeof EPost.event !== 'undefined') {
                window.RemDisable(EPost.event);
            }
            */
        },
        success: function(resp, xhr, status) {
            console.log('%cServer Request Successful: ', window.CONST.c_skgreen);
            console.log(resp);
            if (typeof e_post.event !== 'undefined') {
                window.remDisable(e_post.event);
            }
            window.responseAnalysis(resp);
        }
    };
    $.ajax(request);



}

function addDisable(target) {
    if (typeof target[0].nodeName !== 'undefined' && target[0].nodeName.toLowerCase() == 'a') {
        target.attr('style', 'pointer-events: none;');
        target.attr('disabled', 'disabled');
        target.attr('tabindex', '-1');
    } else {
        target.attr('disabled', 'disabled');
    }
}

function remDisable(target) {
    if (typeof target[0].nodeName !== 'undefined' && target[0].nodeName.toLowerCase() == 'a') {
        target.removeAttr('style');
        target.removeAttr('disabled');
        target.removeAttr('tabindex');
    } else {
        target.removeAttr('disabled');
    }

}

function responseAnalysis(data) {
    var error = window.checkErrorOnResponse(data);
    if (!error) {
        //window.ReadRQResponse(data);
    }
}

function checkErrorOnResponse(data) {
    var error = false;
    if (typeof data == 'string') {
        console.log('join0');
        if (data.startsWith("<!DOCTYPE html>")) {
            console.log('join1');
            error = true;
            let html = $(data);
            let found = html.find("div.middle-box");
            let cont = found[0].innerHTML;
            let conf = window.initModal();
            conf['target'] = 'ErrorModal' + conf['index'];
            conf['type'] = 2;
            conf['size'] = 'lg';
            conf['title'] = window.SYS.dic.unknown_error[window.SYS.lang] + '...';
            conf['cont'] = cont;
            window.genModal(conf);
        } else if (data.startsWith("<pre ")){
            console.log('join2');
            error = true;
            let conf = window.initModal();
            conf['target'] = 'Data-Output-' + conf['index'];
            conf['type'] = 2;
            conf['size'] = 'lg';
            conf['title'] = window.SYS.dic.unknown_error[window.SYS.lang] + '...';
            conf['cont'] = data;
            console.log(conf);
            window.genModal(conf);
        }
    } else if (typeof data == 'object') {
        console.log(data);
        if ([1, 2, 3, 4].includes(data['in'])) {
            data['data'] = window.cleanJsonString(data['data']);
            var conf = window.initModal();
            conf['size'] = 'lg';
            conf['type'] = data['in'];
            conf['cont'] = data['data'];
            conf['refr'] = data['ref'] || false;
            window.genModal(conf);
            error = true;
        }
    }
    return error;


    /*
    var endtag = data.slice(-2);
    if (endtag == '\\n' || endtag == 'r>' || endtag == 'e>') {
        error = true;
    }
    if (error) {
        var conf = window.InitModal();
        conf['size'] = 'lg';
        conf['type'] = 0;
        //conf['title'] = 'Error de Sistema o Bug de Programación (Navegación).';
        conf['cont'] = data + '<br><span class="blink_me"><b> ERROR ERROR ERROR ERROR ERROR</b> </span><br><b>Si usted Ve este mensaje le recomendamos enviarlo a tecnología para su seguimiento.</b>';
        conf['refr'] = false;
        window.ModalGen(conf);
    }
    */

}