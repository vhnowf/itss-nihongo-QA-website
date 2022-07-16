import { numberToCurrency } from '@core/helpers/product'; 

Vue.mixin({
    data: function() {
        return {
            globalData: {
            }
        }
    },
    created: function () {
        // this.globalData = JSON.parse($('#globalData').val());
    },
    methods: {
        baseUrl: function(path) {
			if(path && path.toString().slice(0, 1) == '/') {
				return BASE_URL + path;
			}

			return BASE_URL + '/' + path;
		},
        urlToDomain: function(url) {
            let domain = (new URL(url));

            return domain.hostname;
        },
        roundMoney: function(value) {
			return Math.round(value / 1000) * 1000;
		},
        strToJson: function(str) {
            return JSON.parse(str);
        },
        numberToCurrency: function (inputVal, fixed = false, blur = true) {
			return numberToCurrency(inputVal, fixed, blur);
        },
        categoryToTree: function(categories, dAll = true, dNull = true) {
            let treeCategories = [];
            if(dAll) {
                treeCategories.push({
                    id: 'all',
                    label: 'Tất cả'
                });
            }
            if(dNull) {
                treeCategories.push({
                    id: 'NULL',
                    label: 'NULL'
                });
            }
            categories.forEach(item => {
                let children = [];
                item.childs.forEach(child => {
                    let children1 = [];
                    child.childs.forEach(child1 => {
                        children1.push({
                            id: child1.id,
                            label: child1.title,
                        });
                    });

                    let children2 = {
                        id: child.id,
                        label: child.title
                    };
                    if(children1.length > 0) {
                        children2.children = children1;
                    }
                    children.push(children2);
                });
                let data = {
                    id: item.id,
                    label: item.title
                };
                if(children.length > 0) {
                    data.children = children;
                }
                treeCategories.push(data);
            });

            return treeCategories;
        }
    }
})
