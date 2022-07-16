import { getDefaultPrice, numberToCurrency } from '@core/helpers/product'; 

Vue.mixin({
    data: function() {
        return {}
	},
    created: function() {
	},
	computed: {
	},
	methods: {
		baseUrl: function(path) {
			let base_url = BASE_URL;
			path = path.toString();
			if(this.$i18n.locale != 'vi' && path.indexOf(".") == -1){
				base_url= BASE_URL +'/'+ this.$i18n.locale ;
			}
			if(path && path.toString().slice(0, 1) == '/') {
				return base_url + path;
			}

			return base_url + '/' + path;
		},
		baseApiUrl: function(path) {
			if(path.toString().slice(0, 1) == '/') {
				return BASE_API_URL + path;
			}

			return BASE_API_URL + '/' + path;
		},
		roundMoney: function(value) {
			return Math.round(value / 1000) * 1000;
		},
		numberToCurrency: function (inputVal, fixed, blur) {
			return numberToCurrency(inputVal, fixed, blur);
		},
		copyToClipboard: function(value) {
            let $temp = $("<textarea>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
		},
		strToJson: function(str) {
			return JSON.parse(str);
		},
		setParamSearch: function(parameter) {
            let str = [],
                newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;

            if (Object.keys(parameter).length > 0) {
                for (var p in parameter)
                    if (parameter.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(parameter[p]));
                }

                newUrl += '?' + str.join("&");
            }

            window.history.pushState({ path: newUrl }, '', newUrl);
		},
		classValid: function(column, ipClass = 'form-control') {
			let classValid = ipClass;
			if(column) {
				classValid += ' is-invalid';
			}

			return classValid;
		},
	}
});
