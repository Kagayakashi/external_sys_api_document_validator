var captcha = sliderCaptcha({
    id: 'captcha',
    repeatIcon: 'fa fa-redo',
    onSuccess: function () {
        /*
        var handler = setTimeout(function () {
            window.clearTimeout(handler);
            captcha.reset();
        }, 500);
        */
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                location.reload();
            }
        };
        xmlhttp.open("POST", "/", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("captcha=simourg");
    }
});
