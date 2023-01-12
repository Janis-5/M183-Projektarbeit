function deletePost(id) {
    console.log("p_" + id);
    var request = new XMLHttpRequest();

    request.open("POST", "/M183-Projektarbeit/public/ajax1.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("func=p_delete&id=" + id);

    //var myobj = document.getElementById("p_" + id);
    //myobj.remove();
}

function changeTab() {
    var someTabTriggerEl = document.querySelector('#phone-tab')
    var tab = new bootstrap.Tab(someTabTriggerEl)

    tab.show()
}

function sendToken(id) {
    let phone = document.getElementById(id).value;

    var request = new XMLHttpRequest();
    request.open("POST", "ajax");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("phone="+phone+"");
}