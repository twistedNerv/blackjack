function loader(event) {
    if (event == 'on') {
        $(".loader").fadeIn(300); 
    }
    if (event == 'off') {
        $(".loader").fadeOut(300);
    }
}
