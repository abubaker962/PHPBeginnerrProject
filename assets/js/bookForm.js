function checkPositiveInteger(evt) {
    if (!((evt.keyCode > 95 && evt.keyCode < 106) || (evt.keyCode > 47 && evt.keyCode < 58) || evt.keyCode == 8)) {
        return false;
    }
}