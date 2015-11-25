function next() {
    current = jQuery.data(document.body, "current");
    $('#input'+current).toggleClass("selected");
    current++;
    $('#input'+current).toggleClass("selected");
    jQuery.data(document.body, "current", current);
}
