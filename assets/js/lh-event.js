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
    $('button[name^="e-"],a[name^="e-"]').each(function() {
        $(this).off('click.e');
        $(this).unbind('click.e');
    });
    $(document).on('click.e', 'button[name^="e-"],a[name^="e-"]', function(e) {
        window.stopEvent(e);
        var _this = $(this);
        var _btn_name = $(e.currentTarget).attr('name');
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
                let EPost = {
                    process: _btn_name,
                    form: form_event,
                    event: _this
                };
                let if_error = window.checkRequiredField(form_event, _btn_name);
                console.log(if_error);
                if (if_error.status) {
                    error = window.SYS.dic.ierror1[window.SYS.lang] + '<br>' +
                        window.SYS.dic.ierror2[window.SYS.lang] + ' <b>' + if_error.count + '</b><br>' +
                        window.SYS.dic.ierror3[window.SYS.lang] + '<b>' + if_error.element + '</b>';
                    throw error;
                } else {

                }

                setTimeout(() => {
                    window.hideAllModal();
                }, 10000);


            } catch (e) {
                console.warn('%c' + e, window.CONST.c_red);
                window.EventError(e);
                /*
                window.RemDisable($btnEvent);
                */
            }
        });
    });
}

function EventError(e) {
    let cont = '<div>' + e + '</div>';
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
        var cf_tables = ':input[type=search],input[name^="plg-calendar-"],';
        var cf_summerNot = '.custom-control-input,.note-input,textarea,';
        var cf_other = ':input[type=file], :input[type=button], :input[type=submit], :input[type=reset], :input[type=checkbox]:not(:checked)';
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