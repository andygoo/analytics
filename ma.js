(function () {
    var params = {};
    if(document) {
        params.domain = document.domain || ''; 
        params.url = document.URL || ''; 
        params.title = document.title || ''; 
        params.referrer = document.referrer || ''; 
    }
    if(window && window.screen) {
        params.sw = window.screen.width || 0;
        params.sh = window.screen.height || 0;
    }
    if(navigator) {
        params.lang = navigator.language || ''; 
    }
    if(_maq) {
        for(var i in _maq) {
            switch(_maq[i][0]) {
                case '_setAccount':
                    params.account = _maq[i][1];
                    break;
                default:
                    break;
            }
        }
    }
    var args = '';
    for(var i in params) {
        if(args != '') {
            args += '&';
        }
        args += i + '=' + encodeURIComponent(params[i]);
    }
    var img = new Image(1, 1);
    img.src = 'http://127.0.0.1:10099/wap.gif?' + args;
})();