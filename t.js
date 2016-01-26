(function () {
	var params = {}
	var url = document.URL;
	url = document.URL.split('?')[0];
	url = url.replace(/\/*$/, '') + '/';
	var reg_ptn_home = /\.com(\/\S{2,3})?\/$/;
	var reg_ptn_list = /\.com(\/\S{2,3})?\/vehicle_list/;
	var reg_ptn_detail = /\.com(\/\S{2,3})?\/details\/(\d+)\.html/;
	var page = '';
	if (reg_ptn_list.test(url)) {
		page = 'list';
	} else if (reg_ptn_detail.exec(url)) {
		var rs = reg_ptn_detail.exec(url);
		page = 'detail';
		params.vid = rs[2];
	} else if (reg_ptn_home.test(url)) {
		page = 'home';
	}
	if (page != '') {
		params.page = page;
		params.uid = getCookie('HCUID');
		params.entrance = getCookie('entrance');
		
		var img_url = '';
		for(var i in _maq) {
			if(_maq[i][0] == '_setPlatform') {
				var plat = _maq[i][1];
				img_url = 'http://tongji.haoche51.com/'+plat+'.gif';
				if (plat == 'az' || plat == 'ios') {
					params.udid = getCookie('udid');
				}
			}
		}
		console.log(params);
		if (img_url != '') {
			var args = '';
			for(var i in params) {
				if(args != '') {
					args += '&';
				}
				args += i + '=' + encodeURIComponent(params[i]);
			}
			var img = new Image(1, 1);
			img.src = img_url + '?' + args;
		}
	}
})();