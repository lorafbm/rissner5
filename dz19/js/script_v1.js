/*проверка на длину имени и телефона*/
function check(name, tel) {
    var n = document.getElementById(name).value.length;
    var t = document.getElementById(tel).value.length;

    if (n == '' || t == '' || n < 2 || t < 7) {
        if (n == "" || n < 2) {

            $('#primn').html('<span>заполните имя! </span>').css('font-size','10px');
            $('#name').css('border', '2px solid #F00');
        }
        if (t == "" || t < 7) {

            $('#primt').html('<span>заполните телефон! </span>').css('font-size','10px');
            $('#tel').css('border', '2px solid #F00');
        }
        return false;
    }
    else {
        $.ajax({
            url: '/dz19/check.php',
            type: "POST",
            cache: false,
            data: {name: $('#name').val(), tel: $('#tel').val()},
            success: function (msg) {
                var response = JSON.parse(msg);

                if (response.status != 'ok') {

                    $('#name').css('border', '2px solid #F00');
                    $('#tel').css('border', '2px solid #F00');
                }
                else if (response.status == 'ok') {
                    $("#name, #tel").css('border', '1px solid green');
                    $('#primn,#primt').html('');
                    $("#form").remove();
                    $('#myModal').css('text-align', 'center');
                    $(".title").html("Спасибо за заявку!").css('padding-top', '55px');
                    $("#p").html("Наш менеджер перезвонит Вам в ближайшее время").css('padding-bottom', '84px');
                }
            },
            error: function (x, t, m) {
                alert('что-то не так...');
            }
        });
        return false;
    }
}

function checkform(name1, tel1) {
    var n = document.getElementById(name1).value.length;
    var t = document.getElementById(tel1).value.length;

    if (n == '' || t == '' || n < 2 || t < 7) {
        if (n == "" || n < 2) {

            $('.primn1').html('<span>заполните поле! </span>').css('font-size','10px');
            $('#name1').css('border', '2px solid #F00');
        }
        if (t == "" || t < 7) {

            $('.primt1').html('<span>заполните поле! </span>').css('font-size','10px');
            $('#tel1').css('border', '2px solid #F00');
        }
        return false;
    }
    else {
        $.ajax({
            url: '/dz19/check.php',
            type: "POST",
            cache: false,
            data: {name: $('#name1').val(), tel: $('#tel1').val()
            },
            success: function (msg) {
                var response = JSON.parse(msg);

                if (response.status != 'ok') {

                    $('#name1').css('border', '2px solid #F00');
                    $('#tel1').css('border', '2px solid #F00');
                }
                else if (response.status == 'ok') {

                    $("#name1, #tel1").css('border', '1px solid green');
                    $('.primn1,.primt1').html('');
                    $('form[id=form1]').trigger('reset');
                    $("#modalAfter").modal('show');
                }
            },
            error: function (x, t, m) {
                alert('что-то не так...');
            }
        });
        return false;
    }
}
function checkform2(name2, tel2) {
    var n = document.getElementById(name2).value.length;
    var t = document.getElementById(tel2).value.length;

    if (n == '' || t == '' || n < 2 || t < 7) {
        if (n == "" || n < 2) {

            $('.primn1').html('<span>заполните поле! </span>').css('font-size','10px');
            $('#name2').css('border', '2px solid #F00');
        }
        if (t == "" || t < 7) {

            $('.primt1').html('<span>заполните поле! </span>').css('font-size','10px');
            $('#tel2').css('border', '2px solid #F00');
        }
        return false;
    }
    else {
        $.ajax({
            url: '/dz19/check.php',
            type: "POST",
            cache: false,
            data: {name: $('#name2').val(), tel: $('#tel2').val()
            },
            success: function (msg) {
                var response = JSON.parse(msg);

                if (response.status != 'ok') {

                    $('#name2').css('border', '2px solid #F00');
                    $('#tel2').css('border', '2px solid #F00');
                }
                else if (response.status == 'ok') {

                    $("#name2, #tel2").css('border', '1px solid green');
                    $('.primn1,.primt1').html('');
                    $('form[id=form2]').trigger('reset');
                    $("#modalAfter").modal('show');
                }
            },
            error: function (x, t, m) {
                alert('что-то не так...');
            }
        });
        return false;
    }
}
/*галерея картинок fancy*/
$(document).ready(function () {
    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        prevEffect: 'none',
        nextEffect: 'none'
    });
});

//счетчик


window.onload = function () // дожидаемся загрузки страницы
{
    timer(); // вызываем функцию инициализации таймера
}
year = 2017;
month = 9;
day = 13;
hour = 0;
minute = 0;
second = 0;


function timer() {
    var today = new Date();
    //Выбранная дата
    month = --month; // уменьшаем месяц на один тк в js месяц начинается с 0 а не с 1.
    var currentDate = new Date(year, month, day, hour, minute, second);
    //Разница во времени
    var dateDifference = currentDate.getTime() - today.getTime();
    //Дата, созданная из остатка времени
    var remainsDate = new Date(dateDifference);

    var remainsSec = (Math.floor(remainsDate / 1000));
    var days = (Math.floor(remainsSec / (24 * 60 * 60)));
    var secInLastDay = remainsSec - days * 24 * 3600;
    var hours = (Math.floor(secInLastDay / 3600));
    var secInLastHour = secInLastDay - hours * 3600;
    var minutes = (Math.floor(secInLastHour / 60));

    var seconds = secInLastHour - minutes * 60;
    if (days < 10) {
        days = "0" + days;
    }
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    if (dateDifference > 0) { // проверка - истекла ли дата обратного отсчета

        function secOut() {
            if (seconds == 0) { // если секунду закончились то
                if (minutes == 0) { // если минуты закончились то
                    if (hours == 0) { // если часы закончились то
                        if (days == 0) { // если дни закончились то
                            alert("Установленная дата уже прошла");
                        }
                        else {
                            days--; //уменьшаем кол-во дней
                            if (days < 10) {
                                days = "0" + days;
                            }
                            hours = 23; // // обновляем часы
                            minutes = 59; // обновляем минуты
                            seconds = 59; // обновляем секунды
                        }
                    }
                    else {
                        hours--; //уменьшаем кол-во часов
                        if (hours < 10) {
                            hours = "0" + hours;
                        }
                        minutes = 59; // обновляем минуты
                        seconds = 59; // обновляем секунды
                    }
                }
                else {
                    minutes--; //уменьшаем кол-во минут
                    if (minutes < 10) {
                        minutes = "0" + minutes;
                    }
                    seconds = 59; // обновляем секунды
                }
            }
            else {
                seconds--; // уменьшаем кол-во секунд
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
            }

            out = "<div class='countbox-num'><div class='countbox-days'><span></span>" + days + "</div></div><div class='deviderr'>:</div>" +

                "<div class='countbox-num'><div class='countbox-hours'><span></span>" + hours + "</div></div><div class='deviderr'>:</div>" +

                "<div class='countbox-num'><div class='countbox-mins'><span></span>" + minutes + "</div></div><div class='deviderr'>:</div>" +

                "<div class='countbox-num'><div class='countbox-secs'><span></span>" + seconds + "</div></div>"
            ;
            var list = document.getElementsByClassName("countbox");
            for (var i = 0; i < list.length; i++) {
                list[i].innerHTML = out;
            }
            // обновляем значения таймера на странице
        }
        timerId = setInterval(secOut, 1000) // устанавливаем вызов функции через каждую секунду
    }
    else {
        out = "<div class='countbox-num'><div class='countbox-days'><span></span>00</div></div><div class='deviderr'>:</div>" +

            "<div class='countbox-num'><div class='countbox-hours'><span></span>00</div></div><div class='deviderr'>:</div>" +

            "<div class='countbox-num'><div class='countbox-mins'><span></span>00</div></div><div class='deviderr'>:</div>" +

            "<div class='countbox-num'><div class='countbox-secs'><span></span>00</div></div>"
        ;
        var list = document.getElementsByClassName("countbox");
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = out;
        }
    }
}



