window.CONST = {
    'c_red': 'background: #222; color: red',
    'c_orange': 'background: #222; color: orange',
    'c_green': 'background: #222; color: green',
    'c_skgreen': 'background: #222; color: #bada55',
    'c_blue': 'background: white; color: blue',
    'c_yellow': 'background: #222; color: yellow',
    'c_white': 'background: #222; color: white',
    'c_melon': 'background: #222; color: #FF5733',
};

Object.defineProperty(window.CONST, "CONST", {
    value: window.CONST,
    writable: false,
    enumerable: true,
    configurable: false
});

function initSystemVar() {
    return new Promise((resolve, reject) => {
        window.SYS = {
            'error': false,
            'user_interaction': false,
            'voice_ia': {},
            'ser_conn': {
                'serv_chk': true,
                'serv_sta': false,
                'serv_time_a': 10000,
                'serv_time_b': 3000,
            },
            'lang': document.documentElement.lang.split('-')[0],
            'dic': [],
            'options': {
                'refresh': true,
                'timer': {
                    'wait': 4000,
                    'refresh': 5000,
                },
            },
            'input_edited': [],
        };
        window.getUserInteraction();
        window.initSystemAudio();
        window.initGenericDic().then((result) => {
            console.log('%cLoaded Global Variable  ------> Started.', window.CONST.c_green);
            resolve(true);
        });
    });
}

function initGenericDic() {
    return new Promise((resolve, reject) => {
        var dic = $.get('/dic/dic.csv');
        $.when(dic).done((dato) => {
            var dic = dato;
            var lines = dic.split("\n");
            var headers = lines[0].split(";");
            var obj = [];
            for (var c1 = 1; c1 < lines.length; c1++) {
                if (lines[c1] == undefined || lines[c1].trim() == "") {
                    continue;
                }
                var words = lines[c1].split(";");
                var index = words[0];
                obj[index] = {};
                headers.forEach((k, i) => {
                    if (i > 0) {
                        obj[index][k] = words[i];
                    }
                })
            }
            window.SYS.dic = obj;
            resolve(true);
        });
    });
}

function initSystemAudio() {
    var path = '/assets/audio/' + window.SYS.lang + '/';
    var playlist = [
        "correct.mp3",
        "correct_fail_email.mp3",
        "error.mp3",
        "fail_x_3.mp3",
        "login_error.mp3",
        "out_form.mp3"
    ];
    playlist.forEach((src) => {
        src = path + src;
        var fileNameIndex = src.lastIndexOf("/") + 1;
        var filename = src.substr(fileNameIndex).replace(/\.[^/.]+$/, "");
        window.SYS.voice_ia[filename] = src;
    });

    Object.entries(window.SYS.voice_ia).forEach(([key, value]) => {
        var sound =
            '<audio id ="' + key + '" class="sound-player" preload="auto" style="display:none;">' +
            '<source src="' + value + '" />' +
            '<embed src="' + value + '" hidden="true" loop="false"/>' +
            '</audio>';
        document.getElementById('audio').insertAdjacentHTML('beforeend', sound);
        document.getElementById(key).load();
    });
}

function getUserInteraction() {
    document.body.addEventListener('scroll', (e) => {
        window.handleInteraction(e);
    });
    document.body.addEventListener('keydown', (e) => {
        window.handleInteraction(e);
    });
    document.body.addEventListener('click', (e) => {
        window.handleInteraction(e);
    });
    document.body.addEventListener('touchstart', (e) => {
        window.handleInteraction(e);
    });
}

function handleInteraction(e) {
    window.SYS.user_interaction = true;
}