// Common Javascript functions

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "an unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Google Chrome"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		}
	]

};
BrowserDetect.init();

if((BrowserDetect.browser=="Explorer" && BrowserDetect.version <= 6) || 
	(BrowserDetect.browser == "Mozilla" && BrowserDetect.version < 2)) {
	alert('You are using an old browser. The functionality and interface of the application maynot appear as intended.\nUpgrade to a new browser');
} 
if(BrowserDetect.version == "an unknown version" || BrowserDetect.browser == "an unknown browser") {
	alert('You are currently using a browser this web application was not tested on. Please check the supported browser page\nThe functionality and interface of the application maynot appear as intended.');
} 
