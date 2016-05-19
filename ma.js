(function () {
	function setCookie(cname, cvalue, exdays) {
		var expires = '';
		if (exdays > 0) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			expires = 'expires=' + d.toUTCString();
		}
		document.cookie = cname + '=' + cvalue + '; path=/; ' + expires;
	}
	function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0; i<ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') {
	        	c = c.substring(1);
	        }
	        if (c.indexOf(name) != -1) {
	        	return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	}
	function getUuid() {
		var s = [];
		var hexDigits = "0123456789abcdef";
		for (var i = 0; i < 36; i++) {
			s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
		}
		s[14] = "4";
		s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);
		s[8] = s[13] = s[18] = s[23] = "-";
		return s.join('');
	}
	
    var params = {};
	params.refer = document.referrer; 
	params.screen = window.screen.width + 'x' + window.screen.height;
	var uuid = getCookie('uuid');
	if (!uuid) {
		uuid = getUuid();
		setCookie('uuid', uuid, 365);
	}
	params.uid = uuid;
	
    var args = '';
    for(var i in params) {
        if(args != '') {
            args += '&';
        }
        args += i + '=' + encodeURIComponent(params[i]);
    }
    var img = new Image(1, 1);
    img.src = 'http://127.0.0.1:10099/m.gif?' + args;
})();