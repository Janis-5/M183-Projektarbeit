function deletePost(id) {
    console.log("p_" + id);
    var request = new XMLHttpRequest();

    request.open("POST", "/M183-Projektarbeit/public/ajax1.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("func=p_delete&id=" + id);

    //var myobj = document.getElementById("p_" + id);
    //myobj.remove();
}

function checkRegister(username, password, passwordRepeat) {
    un = document.getElementById(username).value;
    pw = document.getElementById(password).value;
    pwr = document.getElementById(passwordRepeat).value;

    [...document.getElementsByClassName('alert-danger')].forEach(el => {
        el.style.display = 'none';
    });

    var request = new XMLHttpRequest();
    request.open("POST", "Ajax");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("username=" + un + "&password=" + pw + "&passwordrepeat=" + pwr + "&type=checkRegister");

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const errors = JSON.parse(request.responseText);

            if (Object.keys(errors).length != 0) {
                for (const [key, value] of Object.entries(errors)) {
                    const el = document.getElementById('alert' + key);
                    el.style.display = 'block';
                    el.innerText = value;
                }
            }else{
                changeTab();
            }
        }
    }
}

function changeTab() {
    var someTabTriggerEl = document.querySelector('#phone-tab')
    var tab = new bootstrap.Tab(someTabTriggerEl)

    tab.show()
}

function sendToken(id) {
    let phone = document.getElementById(id).value;

    let request = new XMLHttpRequest();
    request.open("POST", "Ajax");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("phone=" + phone + "&type=sendToken");
}