
function start() {
    date = new Date();
    document.getElementById("dateUp").innerHTML = date.toDateString();

}

function goBack() {
    window.history.back();
}

window.onload = start;