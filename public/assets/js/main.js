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
            } else {
                changeTab();
            }
        }
    }
}

function checkLogin(username, password) {
    const tokensuccess = document.getElementById('successToken');
    tokensuccess.style.display = 'none';

    const tokendanger = document.getElementById('dangerToken');
    tokendanger.style.display = 'none';

    un = document.getElementById(username).value;
    pw = document.getElementById(password).value;

    [...document.getElementsByClassName('alert-danger')].forEach(el => {
        el.style.display = 'none';
    });

    var request = new XMLHttpRequest();
    request.open("POST", "Ajax");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("username=" + un + "&password=" + pw + "&type=checkLogin");

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            const errors = JSON.parse(request.responseText);

            if (Object.keys(errors).length != 0) {
                for (const [key, value] of Object.entries(errors)) {
                    const el = document.getElementById('alert' + key);
                    el.style.display = 'block';
                    el.innerText = value;
                }
            } else {
                changeTab();
                console.log(request.responseText);

                if (!request.responseText || request.responseText == '[]') {
                    tokensuccess.style.display = 'block';
                    tokensuccess.innerText = 'Token send';
                } else {
                    tokendanger.style.display = 'block';
                    tokendanger.innerText = request.responseText;
                }
            }
        }
    }
}

function checkLoginSimple(username, password) {
    un = document.getElementById(username).value;
    pw = document.getElementById(password).value;

    [...document.getElementsByClassName('alert-danger')].forEach(el => {
        el.style.display = 'none';
    });

    var request = new XMLHttpRequest();
    request.open("POST", "Ajax");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("username=" + un + "&password=" + pw + "&type=checkLoginSimple");

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            console.log(request.responseText.charAt(0));
            if (request.responseText.charAt(0) == '<') {
                location.reload();
            }
            const errors = JSON.parse(request.responseText);

            if (Object.keys(errors).length != 0) {
                for (const [key, value] of Object.entries(errors)) {
                    const el = document.getElementById('alert' + key);
                    el.style.display = 'block';
                    el.innerText = value;
                }
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
    const phonealert = document.getElementById('alertPhone');
    phonealert.style.display = 'none';

    const tokensuccess = document.getElementById('successToken');
    tokensuccess.style.display = 'none';

    const tokendanger = document.getElementById('dangerToken');
    tokendanger.style.display = 'none';

    if (phone.length == 11 && /^\d+$/.test(phone)) {
        let request = new XMLHttpRequest();
        request.open("POST", "Ajax");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("phone=" + phone + "&type=sendToken");

        request.onreadystatechange = function () {
            console.log(request.readyState);
            console.log(request.status);

            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText) {
                    tokendanger.style.display = 'block';
                    tokendanger.innerText = request.responseText;
                } else {
                    tokensuccess.style.display = 'block';
                    tokensuccess.innerText = 'Token send';
                }
            }/*else{
                tokendanger.style.display = 'block';
                tokendanger.innerText = 'Request Faild, try again later';
            }*/
        }

        //console.log("test1");
    } else {
        //console.log("test2");
        phonealert.style.display = 'block';
        phonealert.innerText = 'Invalid Format';
    }
}