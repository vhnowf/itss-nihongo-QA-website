export const roundMoney = (value) => {
    return Math.round(value / 1000) * 1000;
}

// Chuyển tiền từ dạng số sang string và format
export const numberToCurrency = (inputVal, fixed, blur) => {
    if(fixed === undefined) {
        fixed = false;
    }
    
    if(blur === undefined) {
        blur = false;
    }

    // don't validate empty input
    if(!inputVal) {
        return 0;
    }
    
    if(blur) {
        if (inputVal === "" || inputVal == 0) {
            return 0;
        }
    }
   
    if(inputVal.length == 1) {
        return parseInt(inputVal);
    }

    inputVal = ''+inputVal;
    
    let negative = '';
    if(inputVal.substr(0, 1) == '-'){
        negative = '-';
    }
    // check for decimal
    if (inputVal.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = inputVal.indexOf(".");

        // split number by decimal point
        var left_side = inputVal.substring(0, decimal_pos);
        var right_side = inputVal.substring(decimal_pos);

        // add commas to left side of number
        left_side = left_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(fixed && right_side.length > 3) {
            right_side = parseFloat(0+right_side).toFixed(2);
            right_side =  right_side.substr(1, right_side.length);
        }

        // validate right side
        right_side = right_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Limit decimal to only 2 digits
        if(right_side.length > 2) {
            right_side = right_side.substring(0, 2);
        }
    
        if(blur && parseInt(right_side) == 0) {
            right_side = '';
        }

        // join number by .
        // inputVal = left_side + "." + right_side;

        if(blur && right_side.length < 1) {
            inputVal = left_side;
        } else {
            inputVal = left_side + "." + right_side;
        }
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        inputVal = inputVal.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    if(inputVal.length > 1 && inputVal.substr(0, 1) == '0' && inputVal.substr(0, 2) != '0.' ) {
        inputVal = inputVal.substr(1, inputVal.length);
    } else if(inputVal.substr(0, 2) == '0,') {
        inputVal = inputVal.substr(2, inputVal.length);
    }

    return negative+inputVal;
}
