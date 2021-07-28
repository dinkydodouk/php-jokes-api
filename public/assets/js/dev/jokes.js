$(document).ready(function() {
    ajaxCall(1);

    $('#numberOfJokes').on('change', function (e) {
        ajaxCall(e.target.value);
    });

    $('#generateJokes').on('click', function () {
        ajaxCall($('#numberOfJokes').val());
    })
});

function ajaxCall(num) {
    $.ajax({
        url: '/ajax/jokes/fetchJokes',
        method: 'post',
        dataType: 'json',
        data: {
            'joke_number': num
        },
        success: function (res) {
            displayJoke(res);
        },
        error: function (err) {
            displayError(err['responseJSON']['message']);
        }
    })
}

function displayJoke(res) {
    $('#jokes').html('');
    $.each(res, function (i,v) {
        let title = 'General Jokes';
        let setup = `<p><strong>${v.setup}</strong></p>`;
        let joke = `<p>${v.joke}</p>`;
        let image = '/assets/images/joker.png';
        if( typeof v.id !== 'undefined' ) {
            title = 'Chuck Norris Jokes';
            setup = '';
            image = '/assets/images/chuck-norris.png';
        }

        let html = `<div class="d-flex p-4 bg-white shadow-sm mb-4">
            <div class="flex-shrink-0">
                <img src="${image}" alt="Joke Image">
            </div>
            <div class="flex-grow-1 ms-3">
                <h4>${title}</h4>
                ${setup}
                ${joke}
            </div>
        </div>`;

        $('#jokes').append(html);
    })
}

function displayError(message)
{
    $('#jokes').html('');

    let html = `<div class="alert alert-danger" role="alert">
            <p><strong>Error:</strong> ${message}</p>
            <p>Please report this error to the Webmaster.</p>
        </div>`;

    $('#jokes').append(html);
}