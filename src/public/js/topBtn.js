let topBtn = document.getElementById('topBtn');

window.onscroll = function () { scrollFunction() };


function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topBtn.style.display = "block";
    } else {
        topBtn.style.display = "none";
    }
}


function onTop() {
    document.body.scrollTop = 0; //safari
    document.documentElement.scrollTop = 0; // Chrome, Firefox, Opera
}