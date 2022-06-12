"use strict";

import { notyf } from "./app";
import { csrfToken } from "./app";

// $(document).$(document).on('click', '.pagination a', function(e) {
//     e.preventDefault();
// });

//Добавление словаря в избранное
$(document).on('click', '.favorite-btn', function (e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let data = {
        id: $(this).data('id'),
        type: $(this).data('type')
    }
    console.log(data.id);

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            id: data.id,
            type: data.type
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            response = data;
            notyf.success({
                message: response.message
            });
            $(this).parent('.btn-container').html(data.view);
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
        }
    });
});

//Фильтры (дефолт страница 1)
function ajaxFilter (page= 1) {
    let uri = $('.dictionaries-section').data('uri');
    let data = {
        type: $('input[name="type-sort"]:checked').data('value'),
        chapter: $('input[name="chapter"]:checked').data('value'),
        search: $('input[name="search"]').val(),
        sort: $('input[name="sort"]:checked').data('value'),
        direction: $('input[name="direction"]').is(':checked') ? 'asc' : 'desc',
        page: page
    }
    let newUri = `${uri}?chapter=${data.chapter}&type=${data.type}&search=${data.search}&page=${data.page}&sort=${data.sort}&direction=${data.direction}`;
    history.replaceState(null, null, newUri);
    console.log(data, uri, newUri);

    $.ajax({
        url: `${uri}`,
        type: 'GET',
        data: {
            type: data.type,
            chapter: data.chapter,
            search: data.search,
            sort: data.sort,
            direction: data.direction,
            page: data.page
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            $('.dictionaries-container').html(data.view);
        },
        error: (data) => {
            console.log(data);
        }
    });
}

//Передача страницы в функцию фильтра при нажатии на пагинаторы
$(document).on('click', '.user-wrapper .dictionaries-section .pagination a', function(e) {
    e.preventDefault();
    $('.pagination li').removeClass('active');
    $(this).parent('li').addClass('active');
    let page = $(this).attr('href').split('page=')[1];
    ajaxFilter(page);
});

//Фильтр при нажатии на радио батон
$('.user-wrapper .dictionaries-section input[type="radio"]').click(function () {
    ajaxFilter();
});

//Фильтр по вхождению при нажатии кнопки Enter
$('.user-wrapper .dictionaries-section input[type="search"]').keydown(function (e) {
    if (e.keyCode === 13) {
        ajaxFilter();
    }
});

//Фильтр по вхождению при нажатии кнопки Search
$('.user-wrapper .dictionaries-section .search-btn').click(function () {
    ajaxFilter();
});

//Фильтр по нажатию чекбокса
$('.user-wrapper .dictionaries-section input[type="checkbox"]').click(function () {
    ajaxFilter();
    if ($('input[name="direction"]').is(':checked')) {
        $('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
    } else {
        $('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
    }
});




//Установка описания типа словаря при выборе типа
$('.type-dict').click(function () {

    let textarea = $('.textarea-subtitle');

    switch ($('.type-dict:checked').val()) {
        case '1':
            textarea.removeClass('d-block').addClass('d-none');
            $('.content-words').removeClass('d-none').addClass('d-block');
            break;
        case '2':
            textarea.removeClass('d-block').addClass('d-none');
            $('.content-phrases').removeClass('d-none').addClass('d-block');
            break;
        case '3':
            textarea.removeClass('d-block').addClass('d-none');
            $('.content-texts').removeClass('d-none').addClass('d-block');
            break;
        case '4':
            textarea.removeClass('d-block').addClass('d-none');
            $('.content-book').removeClass('d-none').addClass('d-block');
            break;
    }
});

//Создание пользовательского словаря
$('.form-dictionary').submit(function(e) {
    e.preventDefault();
    let method = $(this).hasClass('create') ? 'POST' : 'PUT';
    let uri = $(this).attr('action');
    let data = {
        title: $('input[name="title"]').val(),
        description: $('input[name="description"]').val(),
        information: $('input[name="information"]').val(),
        is_publish: $('select[name="is_publish"]').val(),
        is_systemic: typeof $('select[name="is_systemic"]').val() === "undefined" ? 0 : $('select[name="is_systemic"]').val(),
        language: $('select[name="language"]').val(),
        type: $('input[name="type"]:checked').val(),
        text: $('textarea[name="text"]').val()
    }

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            title: data.title,
            description: data.description,
            information: data.information,
            is_publish: data.is_publish,
            is_systemic: data.is_systemic,
            language: data.language,
            type: data.type,
            text: data.text
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block');
            response = data;
            notyf.success({
                message: response.message
            });
            setTimeout(()=>{
                window.location.replace(data.route);
            }, 1000)
        },
        error: (data) => {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block');
            response = data.responseJSON;
            console.log(response);
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
            notyf.error({
                message: response.message
            });
        }
    });
});

//Обновление пользовательского словаря
$('.form-dictionary-update').submit(function(e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).attr('action');
    let data = {
        title: $('input[name="title"]').val(),
        description: $('input[name="description"]').val(),
        information: $('input[name="information"]').val(),
        is_publish: $('select[name="is_publish"]').val(),
        language: $('select[name="language"]').val(),
        type: $('input[name="type"]:checked').val(),
        text: $('textarea[name="text"]').val()
    }

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            title: data.title,
            description: data.description,
            information: data.information,
            is_publish: data.is_publish,
            language: data.language,
            type: data.type,
            text: data.text
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block');
            response = data;
            notyf.success({
                message: response.message
            });
            setTimeout(()=>{
                window.location.replace(data.route);
            }, 1000)
        },
        error: (data) => {
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-block');
            response = data.responseJSON;
            console.log(response);
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
            notyf.error({
                message: response.message
            });
        }
    });
});

//Удаление пользовательского словаря
$('.dictionary-destroy').click(function(e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            response = data;
            notyf.success({
                message: response.message
            });
            setTimeout(()=>{
                window.location.replace(data.route);
            }, 1000)
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
        }
    });
});

//Установка рейтинга словаря (звездочки)
$('.rate-container input[name="rating"]').click( function() {
    let method = $('.rate-container').data('method');
    let uri = $('.rate-container').data('uri');
    let data = {
        grade: $('.rate-container input[name="rating"]:checked').data('value'),
        dictionary: $('.rate-container').data('dict')
    }
    console.log(data, uri);

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            grade: data.grade,
            dictionary: data.dictionary
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            response = data;
            notyf.success({
                message: response.message
            });
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            $('.rate-container input[name="rating"]:checked').prop('checked', false);
            notyf.error({
                message: response.message
            });
        }
    });
});

//Изменение пароля пользователя
$('.change-password').click( function(e) {
    $('.password-group .form-control').removeClass('is-invalid');
    $(`.password-group .invalid-feedback`).removeClass('d-block');
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let data = {
        current_password: $('input[name="current_password"]').val(),
        new_password: $('input[name="new_password"]').val(),
        new_password_confirmation: $('input[name="new_password_confirmation"]').val()
    }

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            current_password: data.current_password,
            new_password: data.new_password,
            new_password_confirmation: data.new_password_confirmation
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            response = data;
            notyf.success({
                message: response.message
            });
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
            notyf.error({
                message: response.message
            });
        }
    });
});

//Изменение ника пользователя
$('.change-name').click( function(e) {
    $(`.form-control[name="name"]`).removeClass('is-invalid');
    $(`.invalid-feedback[for="name"]`).removeClass('d-block');
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let name = $('input[name="name"]').val();

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            name: name
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            response = data;
            notyf.success({
                message: response.message
            });
            if (response.lastname) {
                $('.nickname').text(name);
                $('#dropdownUser').text(name);
                let newUri = window.location.href.replace(response.lastname, name);
                history.replaceState(null, null, newUri);

                $('a').each(function() {
                    let href = $(this).attr('href');
                    let result = href.replace(response.lastname, name);
                    $(this).attr('href', result);
                });
            }
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
            notyf.error({
                message: response.message
            });
        }
    });
});

//Изменение информации about
$('.change-about').click( function(e) {
    $(`.form-control[name="about"]`).removeClass('is-invalid');
    $(`.invalid-feedback[for="about"]`).removeClass('d-block');
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let about = $('textarea[name="about"]').val();
    if (about === "") about = "*null*";

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            about: about
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            response = data;
            notyf.success({
                message: response.message
            });
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
            notyf.error({
                message: response.message
            });
        }
    });
});

//Изменение фотографии пользователя
var cropBoxData;
var canvasData;
var cropper;

$('input[name="img-input"]').change(function () {
    if (cropper) {
        cropperDestroy();
    }

    let file = this.files[0];
    let ext = "не определилось";
    let parts = file.name.split('.');
    if (parts.length > 1) ext = parts.pop();
    let types = ['jpeg', 'png', 'jpg', 'gif'];
    if (types.includes(ext)) {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
        cropperInit();
    }
    else {
        $('input[name="img-input"]').val(null);
    }
});

$('#image-modal').on('shown.bs.modal', function () {
    if ($('#image').attr('src') != '') {
        cropperInit();
    }
});

$('#image-modal').on('hidden.bs.modal', function () {
    if (cropper) {
        cropperDestroy();
    }
});

function cropperDestroy() {
    if (cropper) {
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();
        cropper.destroy();
        cropper = null;
    }
}

function cropperInit() {

    let image = document.getElementById('image');

    setTimeout(
        ()=> {
            cropper = new Cropper(image, {
                aspectRatio: 1 / 1,
                preview: '.img-preview',
                // ready: function () {
                //     //Should set crop box data first here
                //     cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                // }
            });
        }, 500
    )
}

$('.save-image').click(function () {
    if (cropper) {
        let method = $(this).data('method');
        let uri = $(this).data('uri');

        cropper.getCroppedCanvas().toBlob(function (blob) {
            let formData = new FormData();

            formData.append('image', blob);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `${uri}`,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: (data) => {
                    console.log(data);
                    let response = data;
                    notyf.success({
                        message: response.message
                    });

                    $('#image-modal').modal('hide');
                    // $('#image').removeAttr('src');
                    // $('input[name="img-input"]').val('');
                    if (cropper) {
                        cropperDestroy();
                    }
                    $('.delete-image').removeAttr('disabled');
                },
                error: (data) => {
                    let response = data.responseJSON;
                    console.log(response);
                    let errors = [];
                    $.each(response.errors, function (key, value) {
                        errors.push(value);
                    });
                    notyf.error({
                        message: errors
                    });
                },
            });
        });
    }
    else {
        notyf.error({
            message: 'Вы не загрузили фотографию!'
        });
    }
});

$('.delete-image').click(function () {
    let method = $(this).data('method');
    let uri = $(this).data('uri');

    $.ajax({
        url: `${uri}`,
        type: method,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            let response = data;
            notyf.success({
                message: response.message
            });
            $('#image').attr('src', '');
            $('input[name="img-input"]').val('');
            $('.delete-image').attr('disabled', '');
            cropperDestroy();
        },
        error: (data) => {
            let response = data.responseJSON;
            console.log(response);
            let errors = [];
            $.each(response.errors, function (key, value) {
                errors.push(value);
            });
            notyf.error({
                message: errors
            });
        },
    });
});


//Отправка комментария
$('.send-comment').click(function (e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let sendData = {
        comment: $('input[name="comment"]').val(),
        dictionary_id: $(this).data('id')
    };

    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            comment: sendData.comment,
            dictionary_id: sendData.dictionary_id
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            let response = data;
            notyf.success({
                message: response.message
            });
            $('.small-comments-container').append(data.view);
            $('input[name="comment"]').val('');
        },
        error: (data) => {
            let response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
        },
    });
});

//Изменение комментария
$('.comments').on('click', '.update-comment', function (e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    console.log(uri);

    $('input[name="comment"]').focus();
    $('.send-comment').addClass('d-none');
    $('.send-update-comment').removeClass('d-none').data('method', method).data('uri', uri);
});

$('.send-update-comment').click(function (e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let sendData = {
        comment: $('input[name="comment"]').val(),
        dictionary_id: $('.send-comment').data('id')
    };

    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            comment: sendData.comment,
            dictionary_id: sendData.dictionary_id
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            let response = data;
            notyf.success({
                message: response.message
            });
            $(document).find(`.small-comments-container .comment-block[data-id="${data.comment.id}"`).replaceWith(data.view);
            $('.send-update-comment').addClass('d-none');
            $('.send-comment').removeClass('d-none');
            $('input[name="comment"]').val("");
        },
        error: (data) => {
            let response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
        },
    });
});

//Удаление комментария
$('.comments').on('click', '.delete-comment', function (e) {
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let id = $(this).data('id');

    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            dictionary_id: id
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            let response = data;
            notyf.success({
                message: response.message
            });
            $('.small-comments-container').find(`.comment-block[data-id="${data.comment}"`).remove();
        },
        error: (data) => {
            let response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
        },
    });
});

function recordsFilter (page= 1) {
    let uri = $('.dictionary-records-container').data('uri');
    let data = {
        sort: $('input[name="sortRecords"]:checked').data('value'),
        page: page
    }
    let newUri = `${uri}?sort=${data.sort}&page=${data.page}`;
    history.replaceState(null, null, newUri);
    console.log(data, uri, newUri);

    $.ajax({
        url: `${uri}`,
        type: 'GET',
        data: {
            sort: data.sort,
            page: data.page
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data);
            $('.table-records').html(data.view);
        },
        error: (data) => {
            console.log(data);
        }
    });
}

$('.dictionary-records-container input[type="radio"]').click(function () {
    recordsFilter();
});

$(document).on('click', '.dictionary-records-container .pagination a', function(e) {
    e.preventDefault();
    $('.pagination li').removeClass('active');
    $(this).parent('li').addClass('active');
    let page = $(this).attr('href').split('page=')[1];
    recordsFilter(page);
});


//Активность кнопки начала игры. false - не нажата, true - нажата. После нажатия, повторное нажатие невозможно
var playBtn = false;

//Получение данных словаря при нажатии на кнопку начала
$('.play-game-btn').click( function(e) {
    if (playBtn) return;
    playBtn = true;
    e.preventDefault();
    let method = $(this).data('method');
    let uri = $(this).data('uri');
    let data = {
        dictionary: $(this).data('id')
    }
    console.log(data, uri);

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            dictionary: data.dictionary
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: (data) => {
            console.log(data.dictionary);
            console.log(data);
            let arrExcerpt = new Array();
            for (let i = 0; i < data.excerpts.length; i++) {
                arrExcerpt.push(data.excerpts[i].excerpt.split(' '));
            }
            arrExcerpt = [].concat(...arrExcerpt);
            arrExcerpt = arrExcerpt.map(item => `${item} `);
            arrExcerpt[arrExcerpt.length-1] = arrExcerpt[arrExcerpt.length-1].substr(0, arrExcerpt[arrExcerpt.length-1].length - 1);
            GameInit(arrExcerpt, data.dictionary);
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
        }
    });
});

//Инициализация игры
function GameInit(arrExcerpt, dictionary) {
    // $('.traffic-lights .traffic-light').removeClass('disabled').addClass('red');
    let _Seconds = 5;
    $('.game-stats .start-time .time').text(_Seconds);
    let timer;
    timer = setInterval(function() { // запускаем интервал
        if (_Seconds > 0) {
            if (_Seconds === 3) {
                // $('.traffic-lights .traffic-light').removeClass('red').addClass('yellow');
                $('.hidden-text').removeClass('d-flex').hide();

                $.each(arrExcerpt, function (key, value) {
                    if (key === arrExcerpt.length - 1) {
                        $('.game-block .game-text').append(`<span data-key="${key}">${value}<span>`).append(' ');
                    }
                    else {
                        $('.game-block .game-text').append(`<span data-key="${key}">${value.substr(0, value.length-1)}<span>`).append(' ');
                    }
                });
            }
            _Seconds--; // вычитаем 1
            $('.game-stats .start-time .time').text(_Seconds); // выводим получившееся значение в блок
        } else {
            clearInterval(timer); // очищаем интервал, чтобы он не продолжал работу при _Seconds = 0
        }
    }, 1000);

    setTimeout(
        ()=> {
            var game = new Game(arrExcerpt, dictionary);
            $('.traffic-lights .traffic-light').removeClass('yellow').addClass('green');
            // $('.game-block .game-text').empty();

            game.start();
        }, _Seconds * 1000
    )
}

//Сама игра
function Game(arr, dictionary) {
    var interval, self = this, isStart = false;
    this.dictionary = dictionary;
    this.words = arr; //массив со словами
    this.chars = arr.join(''); //массив переведенный в строку
    this.countWords = arr.length; //количество слов в массиве
    this.countChars = arr.map(item => item.length).reduce((prev, cur) => prev + cur); //количество символов в массиве
    this.countCharsInWords = arr.map(item => item.length); //массив, переведенный в массив с количеством символов в элементе исходного массива
    this.wordPosition = 0; //текущий элемент массива this.words на котором сейчас пользователь
    this.charPosition = 0; //текущий элемент массива this.chars на котором сейчас пользователь
    this.char = this.chars[0]; //символ на который будет наживать пользователь
    this.pressedChar = 0; //нажатая клавиша в текущий момент
    this.key = 0; //нажатая клавиша в текущий момент

    this.countMistakes = 0; //кол-во ошибок
    this.percentMistakes = 0; //процент ошибок от кол-ва символов
    this.avgSpeed = 0; //средняя скорость

    this.gameTimer = 0; //игровой таймер в секундах
    this.startTime = 0; //время старта в миллисекундах
    this.endTime = 0; //время окончания в миллисекундах
    this.nowTime = 0; //время сейчас в миллисекундах для рассчета скорости каждую секунду
    this.gameTime = 0; //время игры
    this.mistake = false; //переключатель ошибки
    this.gameStatus = false; //статус игры (играет или завершена)

    //стартует игру
    this.start = function () {
        self.startTime = Date.now();
        $('.start-text').text('Время: ');
        $('input').focus().val('');
        self.game();
        if (!isStart) {
            isStart = true;
            interval = setInterval(function () {
                self.gameTimer++;
                self.nowTime = Date.now()
                let time = (self.nowTime - self.startTime) / 1000;
                self.avgSpeed = Math.round(self.charPosition / time * 60);
                self.updateStats();
            }, 1000);
        }
    };

    this.pause = function () {
        isStart = false;
        clearInterval(interval);
    };

    // this.stop = function () {
    //     self.pause();
    //     self.gameTimer = 0;
    //     self.log()
    // };

    //выделяет активное слово
    this.addActive = function (wordPosition = self.wordPosition) {
        $(`span[data-key="${wordPosition}"]`).addClass('active');
    }

    //удаляет активное слово и мутит
    this.removeActive = function (wordPosition = self.wordPosition) {
        $(`span[data-key="${wordPosition}"]`).removeClass('active').addClass('text-muted');
    }

    //выделяет слово с ошибкой
    this.addError = function (wordPosition= self.wordPosition) {
        $(`span[data-key="${wordPosition}"]`).addClass('error');
        $('#inputtext').addClass('error');
        $('.avg-mistakes .mistake').text(self.countMistakes);
    }

    //удаляет ошибку
    this.removeError = function (wordPosition = self.wordPosition) {
        $(`span[data-key="${wordPosition}"]`).removeClass('error');
        $('#inputtext').removeClass('error');
    }

    this.game = function () {
        self.addActive();
        self.updateKeyboard();
        console.log(self.words, self.chars);
        let lengthWords = 0;

        $('#inputtext').on('input', function () {

            $(document).keydown(function(e) {
                self.key = e.key;
            });

            if (!self.gameStatus) {
                let inputValue = $(this).val();

                if (!self.mistake) {
                    if (inputValue === self.words[self.wordPosition].substr(0, inputValue.length)) {

                        self.pressedChar = inputValue.substr(inputValue.length - 1, inputValue.length);

                        if (self.wordPosition > 0) {
                            self.char = self.chars[inputValue.length + lengthWords];
                            self.charPosition = inputValue.length + lengthWords;
                        }
                        else {
                            self.char = self.chars[inputValue.length];
                            self.charPosition = inputValue.length;
                        }
                        self.updateKeyboard();
                    }
                    else if (inputValue !== self.words[self.wordPosition].substr(0, inputValue.length)) {
                        self.pressedChar = inputValue.substr(inputValue.length - 1, inputValue.length);
                        self.mistake = true;
                        self.countMistakes++;
                        self.addError();
                        self.updateKeyboard();
                        // self.errorKeyboard(self.key);
                    }
                }
                else if (self.mistake) {
                    // self.errorKeyboard(self.key);
                    if (inputValue === self.words[self.wordPosition].substr(0, inputValue.length)) {
                        self.pressedChar = inputValue.substr(inputValue.length - 1, inputValue.length);
                        self.mistake = false;
                        self.removeError();
                        self.updateKeyboard();
                    }
                    else if (inputValue.length < 1) {
                        self.pressedChar = inputValue.substr(inputValue.length - 1, inputValue.length);
                        self.mistake = false;
                        self.removeError();
                        self.updateKeyboard();
                    }
                    else {
                        self.pressedChar = inputValue.substr(inputValue.length - 1, inputValue.length);
                    }
                }

                if (inputValue.length === self.words[self.wordPosition].length && !self.mistake) {
                    self.removeActive();
                    lengthWords += self.words[self.wordPosition].length;
                    self.wordPosition++;
                    self.addActive();
                    $(this).val('');
                }

                if (self.countWords === self.wordPosition) {
                    self.endGame();
                }

                self.errorKeyboard();
                console.log(self.key);
                // console.log(self.pressedChar);
            }
        });
    }

    this.endGame = function () {
        self.pause();
        self.gameStatus = true;
        self.clearKeyboard();
        $('#inputtext').attr('disabled', 'disabled');
        self.percentMistakes =self.countMistakes * 100 / self.countChars;
        $('.avg-mistakes .mistake').text(self.countMistakes);
        $('.avg-mistakes .percent-mistake').text(`(${Math.round(self.percentMistakes)}%)`);
        self.endTime = Date.now();
        self.gameTime = (self.endTime - self.startTime) / 1000;
        self.avgSpeed = self.countChars / self.gameTime * 60;
        $('.avg-speed .speed').text(Math.round(self.avgSpeed));
        self.uploadResultAjax();
    }

    this.uploadResultAjax = function () {
        let response;
        let uri = $('.game-stats').data('uri');
        let method = $('.game-stats').data('method');
        $.ajax({
            url: `${uri}`,
            type: method,
            data: {
                dictionary: self.dictionary.id,
                avg_speed: self.avgSpeed,
                count_mistakes: self.countMistakes,
                percent_mistakes: self.percentMistakes
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: (data) => {
                console.log(data);
                //TODO: оценка словаря
            },
            error: (data) => {
                console.log(data);
                //TODO: предложение авторизироваться
            }
        });
    }

    this.errorKeyboard = function () {
        let key;
        let layout = self.dictionary['language']['lang_code'];
        for (let i = 0; i < keymap[layout].length; i++) {
            if (self.key === keymap[layout][i].letter) {
                key = keymap[layout][i].key;
                break;
            }
        }
        if (self.key === 'Backspace') {
            key = 14;
            $(`.keyboard-button[name='${key}'] div`).addClass('active');
            setTimeout(() => {$(`.keyboard-button[name='${key}'] div`).removeClass('active')}, 160);
        }
        else {
            if (self.mistake) {
                $(`.keyboard-button[name='${key}'] div`).css('background-color', 'rgb(255, 71, 21)');
                setTimeout(() => {$(`.keyboard-button[name='${key}'] div`).removeAttr('style')}, 160);
            }
            else {
                $(`.keyboard-button[name='${key}'] div`).addClass('active');
                setTimeout(() => {$(`.keyboard-button[name='${key}'] div`).removeClass('active')}, 160);
            }
        }


        // $(`.keyboard-button`).removeClass('cHover');

        // if (key > 0) {
        //     $(`.keyboard-button[name='${key}'] div`).css('background-color', 'rgb(255, 71, 21)');
        // }
        // if (shift > 0) {
        //     $(`.keyboard-button[name="shift"]`).addClass('cHover');
        // }
    }

    this.updateKeyboard = function () {

        let key, shift;
        if (self.mistake) {
            key = 14;
            shift = 0;
        }
        else {
            let layout = self.dictionary['language']['lang_code'];
            for (let i = 0; i < keymap[layout].length; i++) {
                if (self.char === keymap[layout][i].letter) {
                    key = keymap[layout][i].key;
                    shift = keymap[layout][i].shift;
                    break;
                }
            }
        }

        $(`.keyboard-button`).removeClass('cHover');

        if (key > 0) {
            $(`.keyboard-button[name='${key}']`).addClass('cHover');
        }
        if (shift > 0) {
            $(`.keyboard-button[name="shift"]`).addClass('cHover');
        }
    }

    this.clearKeyboard = function () {
        $(`.keyboard-button`).removeClass('cHover');
    }

    this.updateStats = function () {
        $('.game-stats .start-time .time').text(self.gameTimer);
        $('.game-stats .avg-speed .speed').text(self.avgSpeed);
    };
}


var keymap = {};
keymap['ru'] = [{letter: 'ё', key: 1, shift: 0},
    {letter: '1', key: 2, shift: 0},
    {letter: '2', key: 3, shift: 0},
    {letter: '3', key: 4, shift: 0},
    {letter: '4', key: 5, shift: 0},
    {letter: '5', key: 6, shift: 0},
    {letter: '6', key: 7, shift: 0},
    {letter: '7', key: 8, shift: 0},
    {letter: '8', key: 9, shift: 0},
    {letter: '9', key: 10, shift: 0},
    {letter: '0', key: 11, shift: 0},
    {letter: '-', key: 12, shift: 0},
    {letter: '=', key: 13, shift: 0},

    {letter: 'й', key: 15, shift: 0},
    {letter: 'ц', key: 16, shift: 0},
    {letter: 'у', key: 17, shift: 0},
    {letter: 'к', key: 18, shift: 0},
    {letter: 'е', key: 19, shift: 0},
    {letter: 'н', key: 20, shift: 0},
    {letter: 'г', key: 21, shift: 0},
    {letter: 'ш', key: 22, shift: 0},
    {letter: 'щ', key: 23, shift: 0},
    {letter: 'з', key: 24, shift: 0},
    {letter: 'х', key: 25, shift: 0},
    {letter: 'ъ', key: 26, shift: 0},
    {letter: '\\', key: 27, shift: 0},

    {letter: 'ф', key: 28, shift: 0},
    {letter: 'ы', key: 29, shift: 0},
    {letter: 'в', key: 30, shift: 0},
    {letter: 'а', key: 31, shift: 0},
    {letter: 'п', key: 32, shift: 0},
    {letter: 'р', key: 33, shift: 0},
    {letter: 'о', key: 34, shift: 0},
    {letter: 'л', key: 35, shift: 0},
    {letter: 'д', key: 36, shift: 0},
    {letter: 'ж', key: 37, shift: 0},
    {letter: 'э', key: 38, shift: 0},

    {letter: 'я', key: 39, shift: 0},
    {letter: 'ч', key: 40, shift: 0},
    {letter: 'с', key: 41, shift: 0},
    {letter: 'м', key: 42, shift: 0},
    {letter: 'и', key: 43, shift: 0},
    {letter: 'т', key: 44, shift: 0},
    {letter: 'ь', key: 45, shift: 0},
    {letter: 'б', key: 46, shift: 0},
    {letter: 'ю', key: 47, shift: 0},
    {letter: '.', key: 48, shift: 0},


    {letter: 'Ё', key: 1, shift: 1},
    {letter: '!', key: 2, shift: 1},
    {letter: '"', key: 3, shift: 1},
    {letter: '№', key: 4, shift: 1},
    {letter: ';', key: 5, shift: 1},
    {letter: '%', key: 6, shift: 1},
    {letter: ':', key: 7, shift: 1},
    {letter: '?', key: 8, shift: 1},
    {letter: '*', key: 9, shift: 1},
    {letter: '(', key: 10, shift: 1},
    {letter: ')', key: 11, shift: 1},
    {letter: '_', key: 12, shift: 1},
    {letter: '+', key: 13, shift: 1},

    {letter: 'Й', key: 15, shift: 1},
    {letter: 'Ц', key: 16, shift: 1},
    {letter: 'У', key: 17, shift: 1},
    {letter: 'К', key: 18, shift: 1},
    {letter: 'Е', key: 19, shift: 1},
    {letter: 'Н', key: 20, shift: 1},
    {letter: 'Г', key: 21, shift: 1},
    {letter: 'Ш', key: 22, shift: 1},
    {letter: 'Щ', key: 23, shift: 1},
    {letter: 'З', key: 24, shift: 1},
    {letter: 'Х', key: 25, shift: 1},
    {letter: 'Ъ', key: 26, shift: 1},
    {letter: '/', key: 27, shift: 1},

    {letter: 'Ф', key: 28, shift: 1},
    {letter: 'Ы', key: 29, shift: 1},
    {letter: 'В', key: 30, shift: 1},
    {letter: 'А', key: 31, shift: 1},
    {letter: 'П', key: 32, shift: 1},
    {letter: 'Р', key: 33, shift: 1},
    {letter: 'О', key: 34, shift: 1},
    {letter: 'Л', key: 35, shift: 1},
    {letter: 'Д', key: 36, shift: 1},
    {letter: 'Ж', key: 37, shift: 1},
    {letter: 'Э', key: 38, shift: 1},

    {letter: 'Я', key: 39, shift: 1},
    {letter: 'Ч', key: 40, shift: 1},
    {letter: 'С', key: 41, shift: 1},
    {letter: 'М', key: 42, shift: 1},
    {letter: 'И', key: 43, shift: 1},
    {letter: 'Т', key: 44, shift: 1},
    {letter: 'Ь', key: 45, shift: 1},
    {letter: 'Б', key: 46, shift: 1},
    {letter: 'Ю', key: 47, shift: 1},
    {letter: ',', key: 48, shift: 1},

    {letter: ' ', key: 49, shift: 0}];

keymap['en'] = [{letter: '`', key: 1, shift: 0},
    {letter: '1', key: 2, shift: 0},
    {letter: '2', key: 3, shift: 0},
    {letter: '3', key: 4, shift: 0},
    {letter: '4', key: 5, shift: 0},
    {letter: '5', key: 6, shift: 0},
    {letter: '6', key: 7, shift: 0},
    {letter: '7', key: 8, shift: 0},
    {letter: '8', key: 9, shift: 0},
    {letter: '9', key: 10, shift: 0},
    {letter: '0', key: 11, shift: 0},
    {letter: '-', key: 12, shift: 0},
    {letter: '=', key: 13, shift: 0},

    {letter: 'q', key: 15, shift: 0},
    {letter: 'w', key: 16, shift: 0},
    {letter: 'e', key: 17, shift: 0},
    {letter: 'r', key: 18, shift: 0},
    {letter: 't', key: 19, shift: 0},
    {letter: 'y', key: 20, shift: 0},
    {letter: 'u', key: 21, shift: 0},
    {letter: 'i', key: 22, shift: 0},
    {letter: 'o', key: 23, shift: 0},
    {letter: 'p', key: 24, shift: 0},
    {letter: '[', key: 25, shift: 0},
    {letter: ']', key: 26, shift: 0},
    {letter: '\\', key: 27, shift: 0},

    {letter: 'a', key: 28, shift: 0},
    {letter: 's', key: 29, shift: 0},
    {letter: 'd', key: 30, shift: 0},
    {letter: 'f', key: 31, shift: 0},
    {letter: 'g', key: 32, shift: 0},
    {letter: 'h', key: 33, shift: 0},
    {letter: 'j', key: 34, shift: 0},
    {letter: 'k', key: 35, shift: 0},
    {letter: 'l', key: 36, shift: 0},
    {letter: ';', key: 37, shift: 0},
    {letter: '\'', key: 38, shift: 0},

    {letter: 'z', key: 39, shift: 0},
    {letter: 'x', key: 40, shift: 0},
    {letter: 'c', key: 41, shift: 0},
    {letter: 'v', key: 42, shift: 0},
    {letter: 'b', key: 43, shift: 0},
    {letter: 'n', key: 44, shift: 0},
    {letter: 'm', key: 45, shift: 0},
    {letter: ',', key: 46, shift: 0},
    {letter: '.', key: 47, shift: 0},
    {letter: '/', key: 48, shift: 0},


    {letter: '~', key: 1, shift: 1},
    {letter: '!', key: 2, shift: 1},
    {letter: '@', key: 3, shift: 1},
    {letter: '#', key: 4, shift: 1},
    {letter: '$', key: 5, shift: 1},
    {letter: '%', key: 6, shift: 1},
    {letter: '^', key: 7, shift: 1},
    {letter: '&', key: 8, shift: 1},
    {letter: '*', key: 9, shift: 1},
    {letter: '(', key: 10, shift: 1},
    {letter: ')', key: 11, shift: 1},
    {letter: '_', key: 12, shift: 1},
    {letter: '+', key: 13, shift: 1},

    {letter: 'Q', key: 15, shift: 1},
    {letter: 'W', key: 16, shift: 1},
    {letter: 'E', key: 17, shift: 1},
    {letter: 'R', key: 18, shift: 1},
    {letter: 'T', key: 19, shift: 1},
    {letter: 'Y', key: 20, shift: 1},
    {letter: 'U', key: 21, shift: 1},
    {letter: 'I', key: 22, shift: 1},
    {letter: 'O', key: 23, shift: 1},
    {letter: 'P', key: 24, shift: 1},
    {letter: '{', key: 25, shift: 1},
    {letter: '}', key: 26, shift: 1},
    {letter: '|', key: 27, shift: 1},

    {letter: 'A', key: 28, shift: 1},
    {letter: 'S', key: 29, shift: 1},
    {letter: 'D', key: 30, shift: 1},
    {letter: 'F', key: 31, shift: 1},
    {letter: 'G', key: 32, shift: 1},
    {letter: 'H', key: 33, shift: 1},
    {letter: 'J', key: 34, shift: 1},
    {letter: 'K', key: 35, shift: 1},
    {letter: 'L', key: 36, shift: 1},
    {letter: ':', key: 37, shift: 1},
    {letter: '"', key: 38, shift: 1},

    {letter: 'Z', key: 39, shift: 1},
    {letter: 'X', key: 40, shift: 1},
    {letter: 'C', key: 41, shift: 1},
    {letter: 'V', key: 42, shift: 1},
    {letter: 'B', key: 43, shift: 1},
    {letter: 'N', key: 44, shift: 1},
    {letter: 'M', key: 45, shift: 1},
    {letter: '<', key: 46, shift: 1},
    {letter: '>', key: 47, shift: 1},
    {letter: '?', key: 48, shift: 1},

    {letter: ' ', key: 49, shift: 0}];
