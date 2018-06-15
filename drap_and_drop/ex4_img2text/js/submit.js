function code1submit() {
    // var pageCoords = gettime() + " ButtonClick( #submitcode1 )";
    // log = log + pageCoords + "\r\n";

    var code1p = $('#code6').offset();
    var code1x = code1p.top;
    var code1y = code1p.left;
    //
    var submitcode1 = $('#drag1').offset();
    var submitcode1x = submitcode1.top;
    var submitcode1y = submitcode1.left;
    //
    var code1dev = code1x - submitcode1x + code1y - submitcode1y;
    //
    //
    var code2p = $('#code2').offset();
    var code2x = code2p.top;
    var code2y = code2p.left;
    var submitcode2 = $("#drag2").offset();
    var submitcode2x = submitcode2.left;
    var submitcode2y = submitcode2.top;
    var code2dev = code2x - submitcode2x + code2y - submitcode2y;
//
    //
    var code3p = $('#code1').offset();
    var code3x = code3p.top;
    var code3y = code3p.left;
    var submitcode3 = $("#drag3").offset();
    var submitcode3x = submitcode3.left;
    var submitcode3y = submitcode3.top;
    var code3dev = code3x - submitcode3x + code3y - submitcode3y;

    var code4p = $('#code5').offset();
    var code4x = code4p.top;
    var code4y = code4p.left;
    var submitcode4 = $("#drag4").offset();
    var submitcode4x = submitcode4.left;
    var submitcode4y = submitcode4.top;
    var code4dev = code4x - submitcode4x + code4y - submitcode4y;

    var code5p = $('#code3').offset();
    var code5x = code5p.top;
    var code5y = code5p.left;
    var submitcode5 = $("#drag5").offset();
    var submitcode5x = submitcode5.left;
    var submitcode5y = submitcode5.top;
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
