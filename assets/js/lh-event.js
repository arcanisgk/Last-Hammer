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
        window.ManagerEvent().then((result) => {
            resolve(true);
        });
    });
}

/* Event Input Detecting Changes*/
function eInputChange() {
    $(document).off('click.ic', ':input');
    $(document).unbind('click.ic', ':input');
    $(document).on('click.ic', ':input', (event, xhr, settings) => {
        let inputs = window.SYS.input_edited;
        let c_name = $(event.currentTarget).attr('name');
        if (typeof c_name !== 'undefined') {
            c_name = 'old-' + c_name;
            if (!(c_name in inputs)) {
                window.SYS.input_edited[c_name] = ($(event.currentTarget).val() == '') ? 'Campo Vacio' : $(event.currentTarget).val();
            }
        }
    });
    $(document).off('change.ic', ':input');
    $(document).unbind('change.ic', ':input');
    $(document).on('change.ic', ':input', (event, xhr, settings) => {
        let inputs = window.SYS.input_edited;
        let c_val = ($(event.currentTarget).val() == '') ? 'Campo Vacio' : $(event.currentTarget).val();
        let c_name = $(event.currentTarget).attr('name');
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
    $('button[name^="p-"],a[name^="p-"]').each(function() {
        console.log($(this));
        $(this).off('click.p');
        $(this).unbind('click.p');
    });
}



/* Event of CRUD MODAL */


//e- prefix event button
//s- prefix event search
//is- real- time search input
//bc- barcode scan

//tp- toogle pass field
//fp- file plugin handler event
//fpd- file plugin (dropzone) handler event