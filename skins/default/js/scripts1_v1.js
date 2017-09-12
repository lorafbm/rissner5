/*вызов прозрачного фона*/
function hideShow(id) {
    var x = document.getElementById(id);
    if (x.style.display == 'block') {
        x.style.display = 'none';
    } else {
        x.style.display = 'block';
   }
}

//всплывающее окно авторизации
jQuery(function () {
    $('nav').on("click", ".go", function () {
    $('#aaa').toggle(500);
        return false;
    });
});


/*проверка на длину логина и пароля и авторизация*/
function check(name, pass) {
    var n = document.getElementById(name).value.length;
    var p = document.getElementById(pass).value.length;

    if (n == '' || p == '' || n < 2 || p < 4) {
        if (n == "" || n < 2) {

            $('#primn').html('<span class="game">заполните логин! </span>');
            $('#name').css('border', '1px solid #F00');

        } else {
            $('#name').css('border', '1px solid green');
            $('#primn').html('');
        }
        if (p == "" || p < 4) {

            $('#primp').html('<span class="game">заполните пароль! </span>');
            $('#pass').css('border', '1px solid #F00');


        } else {
            $('#pass').css('border', '1px solid green');
            $('#primp').html('');
        }
        return false;
    } else {
        if ($('#remember').is(':checked')) {
            var rem = ($('#remember').attr('name'));
            var ip = $('#ip').val();
            var hua = $('#hua').val();
        } else {
            var rem = false;
            var ip = false;
            var hua = false;
        }

        $.ajax({
            url: '/cab/auth',
            type: "POST",
            cache: false,
            data: {name: $('#name').val(), pass: $('#pass').val(), button: '', remember: rem, ip: ip, hua: hua},
            success: function (msg) {
                var response = JSON.parse(msg);

                if (response.status != 'ok') {
                    $('.mess').html("<p class='game'>" + response.status + "</p>");
                    $('.mess').css('display', 'block');
                    $('#name').css('border', '1px solid #F00');
                    $('#pass').css('border', '1px solid #F00');
                } else if (response.status == 'ok') {
                    $("#name, #pass").css('border', '1px solid green');
                    $('#primp,#primn').html('');
                    window.location.href = "/";
                }
            },
        });
        return false;
    }
}

/*комментарии без перезагрузки добавление */
function sendcom(name, email, comments, age, num) {

    $.ajax({
        url: '/comments/main',
        type: "POST",
        cache: false,
        timeout: 3000,
        data: {
            name: $('#name').val(),
            email: $('#email').val(),
            comments: $('#comments').val(),
            age: $('#age').val(),
            button: ''
        },
        success: function (msg) {
            var response = JSON.parse(msg);

            if (response.status == 'ok') {
                form = document.getElementById('commentform');
                form.comments.value = "";
                form.name.value = "";
                form.email.value = "";
                form.age.value = "";
                setTimeout(function () {
                    $('.com').html("<div class='commentboxbodycom'>" + response.comments + "</div>" +
                        "<div class='commentboxname'>-" + response.name + " " + response.age + " лет </div>" +
                        "<div class='commentboxname'>" + response.data + "</div>");
                    $('#info').css('display', 'block');
                    $('#info').css('backgroundColor', '#ccc');
                    $('#info').html('<p class="game">Ваш комментарий принят!</p>');
                    $('#num').html('<p class="game">У нас ' + response.num + ' комментариев:</p></div>');
                }, 2000);

            } else if (response.status != 'ok') {

                $('#info').html(response.status);
                $('#info').css('display', 'block');
                $('#info').css('backgroundColor', '#ccc');
            }

        },
        error: function (x, t, m) {
            if (t === "timeout") {
                $('#info').html('<p class="game">Время ожидания ответа сервера истекло!</p>');
            } else {
                $('#info').html('<p class="game">Сервер не отвечает!</p>');
            }
        }

    });
    return false;
}

/*чат*/
window.onload = function () {
// прижимаем скролл к низу окна
    var messages = document.getElementById("allmess");
    if (messages) {
        messages.scrollTop = messages.scrollHeight;
    }
}
//по клику вставляем имя к кому обращаемся
jQuery(function () {

    $('#allmess').on("click", ".name1", function () {
        var name = $(this).text();
        $('#text').val(name + ', ').focus();
    });
});

// Каждые 20 секунд проверяем сообщения, активных пользователей ,количество пользователей
setInterval(function () {
    showmess();
}, 10000);


//отправка сообщений
function sendMess() {

    $.ajax({
        url: '/chat/add',
        type: "POST",
        cache: false,
        timeout: 20000,
        data: {
            name: $('#name').val(),
            text: $('#text').val(),
            button: ''
        },
        success: function (msg) {

            var response = JSON.parse(msg);
            var newmess = '';
            if (response.status == 'ok') {
                //вывод только автору
                   //вывод админки (удаление сообщений)
                    if (access == 5) {
                      a = '<a class="delmes" onclick="delmes(' + response.id + ');">&#215;</a>';
                    } else {
                      a = "";
                    }
                    newmess = '<div class="com" id=' + response.id + '><div class="commentboxbodycom1" style="background-color:' + response.bc + ';">' + a +
                        '<div class="commentboxname"><span class="name1" style="color:' + color + '">-'
                        + name + '</span>' + response.data + ' id ' + response.id + '</div>' + $('#text').val() + '</div></div>';

                    $('#allmess').append(newmess);
                    // прокрутка сообщений
                    $('#allmess').scrollTop($('#allmess').prop('scrollHeight'));

                form = document.getElementById('message');
                form.text.value = "";//очищаем форму
                $('#info').css('display', 'none');//очищаем инфу
                $('#text').focus();//фокус на поле ввода

            } else if (response.status != 'ok') {

                $('#info').html('<p class="welcome">' + response.status + '</p>');
                $('#info').css('display', 'block');
            }
        },
        error: function (x, t, m) {
            if (t === "timeout") {
                $('#info').css('display', 'block');
                $('#info').html('<p class="welcome">Время ожидания ответа сервера истекло!</p>');
            } else {
                $('#info').css('display', 'block');
                $('#info').html('<p class="welcome">Сервер не отвечает!</p>');
            }
        }

    });
    return false;
}
/*и на стороне клиента через Javascript нужно хранить лишь одну переменную - id последнего сообщения,
 кот-е получил клиент, раз в 5 сек делаешь ajax-запрос, который отправляет эту переменную серверу.
 Сервер тупо возвращает инфу о сообщениях, id которых больше полученного, а также последний id.
 Функция обработчик на стороне клиента добавляет эти сообщения в конец
 (списка, фрейма, div'а.. чего угодно) если список не пуст, а также меняет переменную id на новую.*/
var lastid = 0;
var lastiddel = 0;
//вывод данных чата
function showmess() {
    $.ajax({
        url: '/chat/showmes',
        type: "POST",
        cache: false,
        data: {lastid: lastid, lastiddel: lastiddel},
        success: function (msg) {
            var response = JSON.parse(msg);

            if (!$.isEmptyObject(response.id)) {
                var newmess = '';
                var a = "";

                for (var i in response.id) {
                    // вывод всем кто не автор
                    if (name != response.id[i].name) {
                        //вывод админки (удаление сообщений)
                        if (access == 5) {
                            a = '<a class="delmes" onclick="delmes(' + response.id[i].id + ');">&#215;</a>';
                        } else {
                            a = "";
                        }

                        newmess = '<div class="com" id=' + response.id[i].id + '><div class="commentboxbodycom1" style="background-color:' + response.id[i].bc + ';">' + a +
                            '<div class="commentboxname"><span class="name1" style="color:' + response.id[i].color + '">-'
                            + response.id[i].name + '</span>' + response.id[i].data + ' id ' + response.id[i].id + '</div>' + response.id[i].text + '</div></div>';

                        $('#allmess').append(newmess);
                        // прокрутка сообщений
                        $('#allmess').scrollTop($('#allmess').prop('scrollHeight'));


                    }
                    lastid = response.id[i].id;//меняем значение последнего выведенного сообщения
                }
            }
            if (!$.isEmptyObject(response.del)) {

                for (var k in response.del) {
                    // вывод всем кто не автор
                    if (access != 5) {
                        var delmes = document.getElementById(response.del[k].id_mes);

                        delmes.innerHTML = '<div class="commentboxbodycom1"  style="background-color:#EBF4FB;"><div class="commentboxname"><span class="name1" style="color:' + response.del[k].color + '">-'
                            + response.del[k].name + '</span>' + response.del[k].data_chat + ' id ' + response.del[k].id_mes + '</div>Сообщение было удалено!</div>';
                    }
                    lastiddel = response.del[k].id;//меняем значение удаленного последнего сообщения
                }
            }
            // вывод списка пользователей
            if (!$.isEmptyObject(response.users)) {

                var ull = "";

                for (var i in response.users) {
                    if (response.users[i].access == 5) {

                        ull = ull + '<li style="color:' + response.users[i].color + '; background-color:#ccc">' + response.users[i].name + '</li>';
                    } else {
                        ull = ull + '<li style=color:' + response.users[i].color + '>' + response.users[i].name + '</li>';
                    }
                }
                $('#uonline').html(ull);
            }
            //вывод количества пользователей
            if (!$.isEmptyObject(response.qusers)) {
                $('#num').text(response.qusers);
            }
            $('#text').focus();
        },

    });
    return false;
}

// удаление сообщения модератором
function delmes(id) {
    if (confirm('Удалить?')) {
        $.ajax({
            url: '/chat',
            type: "POST",
            cache: false,
            data: {
                id: id,
                delete: 'delete'
            },
            success: function (msg) {
                var response = JSON.parse(msg);
                //вывод только админу
                if(access==5) {
                    var delmes = document.getElementById(response.id);

                    delmes.innerHTML = '<div class="com" id=' + response.id + '><div class="commentboxbodycom1" style="background-color:#EBF4FB;">'+
                        '<div class="commentboxname"><span class="name1" style="color:' + response.color + '">-'
                        + response.name + '</span>' + response.data + ' id ' + response.id + '</div>Сообщение было удалено!</div></div>';
                }
            },
        });
    }
    return false;
}







