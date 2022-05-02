"use strict";

import { notyf } from "../app";
import { csrfToken } from "../app";

// var modal = new bootstrap.Modal(document.getElementById('report-modal'));

//Фильтры (дефолт страница 1) для админа
function ajaxFilterAdmin (page= 1) {
    let uri = $('.dictionaries-section').data('uri');
    let data = {
        type: $('input[name="type-sort"]:checked').data('value'),
        chapter: $('input[name="chapter"]:checked').data('value'),
        search: $('input[name="search"]').val(),
        direction: $('input[name="direction"]').is(':checked') ? 'asc' : 'desc',
        page: page
    }
    let newUri = `${uri}?chapter=${data.chapter}&type=${data.type}&search=${data.search}&page=${data.page}&&direction=${data.direction}`;
    history.replaceState(null, null, newUri);
    console.log(data, uri, newUri);

    $.ajax({
        url: `${uri}`,
        type: 'GET',
        data: {
            type: data.type,
            chapter: data.chapter,
            search: data.search,
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
$(document).on('click', '.dictionaries-section .pagination a', function(e) {
    e.preventDefault();
    $('.pagination li').removeClass('active');
    $(this).parent('li').addClass('active');
    let page = $(this).attr('href').split('page=')[1];
    ajaxFilterAdmin(page);
});

//Фильтр при нажатии на радио батон
$('.admin-wrapper .dictionaries-section input[type="radio"]').click(function () {
    ajaxFilterAdmin();
});

//Фильтр по вхождению при нажатии кнопки Enter
$('.admin-wrapper .dictionaries-section input[type="search"]').keydown(function (e) {
    if (e.keyCode === 13) {
        ajaxFilterAdmin();
    }
});

//Фильтр по вхождению при нажатии кнопки Search
$('.admin-wrapper .dictionaries-section .search-btn').click(function () {
    ajaxFilterAdmin();
});

//Фильтр по нажатию чекбокса
$('.admin-wrapper .dictionaries-section input[type="checkbox"]').click(function () {
    ajaxFilterAdmin();
    if ($('input[name="direction"]').is(':checked')) {
        $('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
    } else {
        $('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
    }
});

var method, uri, sendData;

//Кнопки доступа (принять/отказ)
$(document).on('click', '.btn-container .access-btn', function (e) {
    e.preventDefault();
    method = $(this).data('method');
    uri = $(this).data('uri');
    sendData = {
        id: $(this).data('id'),
        type: $(this).data('type')
    }
    console.log(1, sendData, uri);

    let response;
    if (sendData.type === "accept" || sendData.type === "wait") {
        $.ajax({
            url: `${uri}`,
            type: method,
            data: {
                id: sendData.id,
                type: sendData.type
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
    }
    else if (sendData.type === "deny") {
        $.ajax({
            url: $(this).data('repuri'),
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: (data) => {
                $('#report-modal textarea[name="report"]').val(data.report.report);
                console.log(data);
            },
            error: (data) => {
                console.log(data);
            }
        });

        // $('#report-modal').show();
    }
});

$(document).on('click', '.modal .access-btn', function (e) {
    e.preventDefault();
    let report = $('textarea[name="report"]').val()

    let response;
    $.ajax({
        url: `${uri}`,
        type: method,
        data: {
            id: sendData.id,
            type: sendData.type,
            report: report
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
            $(document).find(`.btn-container[data-id="${sendData.id}"]`).html(data.view);
            $('#report-modal').modal('hide');
        },
        error: (data) => {
            response = data.responseJSON;
            console.log(response);
            notyf.error({
                message: response.message
            });
            $.each(response.errors, function (key, value) {
                $(`.form-control[name="${key}"]`).addClass('is-invalid');
                $(`.invalid-feedback[for="${key}"]`).text(value).addClass('d-block');
            });
        }
    });
});

$('#report-modal').on('hidden.bs.modal', function () {
    $(`.form-control[name="report"]`).removeClass('is-invalid');
    $(`.invalid-feedback[for="report"]`).removeClass('d-block');
    $('textarea[name="report"]').val('');
});

