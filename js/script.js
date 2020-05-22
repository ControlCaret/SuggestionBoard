function msieCheck() {
    var agent = navigator.userAgent.toLowerCase();
    var connectButton = document.getElementById('connectButton');
    var ieWarning = document.getElementById('ieWarning');
    if ( (navigator.appName == 'Netscape' && navigator.userAgent.search('Trident') != -1) || (agent.indexOf("msie") != -1) ) {
        connectButton.disabled = true;
        ieWarning.style.display = "block";
    }
}

function ieIgnore() {
    var connectButton = document.getElementById('connectButton');
    connectButton.disabled = false;
}

function clearForm() {
    document.Form.reset();
}

function bookmark() {
    var numbersearch = document.getElementById("numbersearch").value;
    location.href="#" + numbersearch;
}

function comment(num) {
    document.getElementById("suggestid").value = num;
    document.getElementById("iframe-comment").src = "commentList.php?suggestid=" + num;
}

new WOW().init();