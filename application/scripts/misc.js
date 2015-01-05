var total;

window.onload = setup;

function checkPassword() {
    var p1 = $("#pass1");
    var p2 = $("#pass2");

    if(p1.val().length < 6 || p1.val() != p2.val()) {
        p1.get(0).setCustomValidity("Password must be at least 6 characters long and they must match");
        p2.get(0).setCustomValidity("");
        return false;
    }
    p1.get(0).setCustomValidity("");
    p1.get(0).setCustomValidity("");
    return true;
}

function printReceipt() {
    window.print();
}

function getTotal() {
    var selections = $("input.prodInCart[type='number']");
    //id of each selection element is the price associated with it
    // value of each selection element is its quantity
    var num = selections.length;
    total = 0;
    for(var i=0; i<num; i++) {
        var item = selections[i];
        var price = parseFloat(item.id);
        var value = parseFloat(item.value);
        total += (price*value);
    }
    return total;
}

function setup() {
    $("input.prodInCart[type='number']").change(function() {
        var _total = getTotal();
        document.getElementById("total").innerHTML = _total;
    })
}