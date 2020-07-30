function ManagerEvent() {
    return new Promise((resolve, reject) => {
        window.eInputChange();
        window.eCRUD();
        console.log('%cLoaded Event Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}

function reloadManagerEvent() {
    return new Promise((resolve, reject) => {
        window.eInputChange();
        window.eCRUD();
        console.log('%cRe-Loaded Event Handler ---------> Started.', window.CONST.c_green);
        resolve(true);
    })
}

/* Event Input Detecting Changes*/
function eInputChange() {
    $(document).off('click.ic', ':input');
    $(document).unbind('click.ic', ':input');
    $(document).on('click.ic', ':input', (e, xhr, s) => {
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
    $(document).on('change.ic', ':input', (e, xhr, settings) => {
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
    Object.entries(inputs).forEach(([key, value], index) => {
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
    $('button[name^="e-"],a[name^="e-"]').each(() => {
        $(this).off('click.e');
        $(this).unbind('click.e');
    });
    $(document).on('click.e', 'button[name^="e-"],a[name^="e-"]', (e) => {
        window.stopEvent(e);
        var _this = $(this);
        var _btn_name = $(e.currentTarget).attr('name');
        window.waitModal().then((result) => {
            try {

                let btn_arr = _btn_name.split('-');
                let forn_arr = [];
                let data_target = '';
                let form = '';
                let form_event = '';

                switch (btn_arr[1]) {
                    case 'login':
                        form_event = 'f-gen-login';
                        forn_arr = form_event.split('-');
                        break;
                    case 'logout':
                        form_event = 'f-gen-logout';
                        forn_arr = form_event.split('-');
                        break;
                    case 'report':
                        form_event = 'f-gen-bugrep';
                        forn_arr = form_event.split('-');
                        dataTarget = _this.attr('data-target');
                        break;
                    case 'desk':
                        window.winRefresh();
                        break;
                    default:
                        form = _this.attr('data-target');
                        if (typeof form == 'undefined') {
                            form_event = $("body form").first().attr('name');
                        } else {
                            form_event = form;
                        }
                        forn_arr = form_event.split('-');
                        break;
                }

                console.log('ejecucion: ', btn_arr, forn_arr, data_target, form, form_event);

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
    let cont = '<div class="d-flex align-items-center">' + e + '</div>';
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

//tp- toogle pass field
//fp- file plugin handler event
//fpd- file plugin (dropzone) handler event



/* custom Function */
function stopEvent(e) {
    e.stopPropagation();
    e.preventDefault();
    e.stopImmediatePropagation();
}