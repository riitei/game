
function code1submit() {
    // var pageCoords = gettime() + " ButtonClick( #submitcode1 )";
    // log = log + pageCoords + "\r\n";

    var code1p = $('#code6').offset();
    var code1x = code1p.top;
    console.log("code1x " + code1x);
    var code1y = code1p.left;
    console.log("code1y " + code1y);
    //
    var submitcode1x = cumulativeOffset(drag1).left;
    // console.log("submitcode1x " + submitcode1x);
    var submitcode1y = cumulativeOffset(drag1).top;
    // console.log("submitcode1y " + submitcode1y);
    var code1dev = code1x - submitcode1x + code1y - submitcode1y;
    console.log("code1dev " + code1dev);

    var code2p = $('#code2').offset();
    var code2x = code2p.top;
    var code2y = code2p.left;
    var submitcode2x = cumulativeOffset(drag2).left;
    var submitcode2y = cumulativeOffset(drag2).top;
    var code2dev = code2x - submitcode2x + code2y - submitcode2y;

    var code3p = $('#code1').offset();
    var code3x = code3p.top;
    var code3y = code3p.left;
    var submitcode3x = cumulativeOffset(drag3).left;
    var submitcode3y = cumulativeOffset(drag3).top;
    var code3dev = code3x - submitcode3x + code3y - submitcode3y;

    var code4p = $('#code5').offset();
    var code4x = code4p.top;
    var code4y = code4p.left;
    var submitcode4x = cumulativeOffset(drag4).left;
    var submitcode4y = cumulativeOffset(drag4).top;
    var code4dev = code4x - submitcode4x + code4y - submitcode4y;

    var code5p = $('#code3').offset();
    var code5x = code5p.top;
    var code5y = code5p.left;
    var submitcode5x = cumulativeOffset(drag5).left;
    var submitcode5y = cumulativeOffset(drag5).top;
    var code5dev = code5x - submitcode5x + code5y - submitcode5y;

    if ((code1dev >= 0) && (code1dev <= 15) &&
        (code2dev >= 0) && (code2dev <= 15) &&
        (code3dev >= 0) && (code3dev <= 15) &&
        (code4dev >= 0) && (code4dev <= 15) &&
        (code5dev >= 0) && (code5dev <= 15)) {
        // gox(25);
        console.log(25);
        // var exampleClass4 = document.getElementById('exampleClass4');
        // exampleClass4.close();
        // var dragcode = document.getElementById('dragcode');
        // dragcode.close();
        // errorcount = 0;
        // talk = 2;
        // dragstage = "2";
        alert("yes");
    }
    else {
        // gox(-10);
        console.log(-10);
        alert("no");
        // errorcount++;
        // var pageCoords = gettime() + " Drag1Error ( " + errorcount + " )";
        // log = log + pageCoords + "\r\n";
    }
};



var cumulativeOffset = function(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
        element = element.offsetParent;
    } while(element);

    return {
        top: top,
        left: left
    };
};
