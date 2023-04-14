function register() {
    document.querySelectorAll('.error').forEach(e => e.remove());

    var fio = document.querySelector("input[name='fio']");
    var email = document.querySelector("input[name='email']");
    var password = document.querySelector("input[name='password']");
    var form = "fio=" + fio.value + "&email=" + email.value + "&Password=" + password.value;
    console.log(form);

    var reg = new XMLHttpRequest();
    reg.open("POST", "../api-cleaning/register.php", false);
    reg.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    reg.onreadystatechange = function () {

        if (reg.readyState == 4) {
            var errors = JSON.parse(reg.response);
            if (reg.response.code == 200) {
                location.href = "../index.html";
            } else {
                if (errors.errors.fio != undefined) {
                    document.querySelector("input[name=\'fio\']").insertAdjacentHTML("afterEnd",
                        '<p class="error" style="color: red;"> Ошибка ввода имени </p>');
                }
                if (errors.errors.email != undefined) {
                    document.querySelector("input[name=\'email\']").insertAdjacentHTML("afterEnd",
                        '<p class="error" style="color: red;"> Ошибка ввода email </p>');
                }
                if (errors.errors.password != undefined) {
                    document.querySelector("input[name=\'password\']").insertAdjacentHTML("afterEnd",
                        '<p class="error" style="color: red;"> Ошибка ввода пароля </p>');
                }
            }
        }
    }
    reg.send(form);
}