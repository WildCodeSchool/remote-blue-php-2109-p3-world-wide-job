document.addEventListener('DOMContentLoaded', () => {
    window.ClassicEditor
        .create(document.querySelector('#offer_longDescription'))
        .then((editor) => {
            editor.model.document.on('change:data', () => {
                document.getElementById('offerDescription').innerHTML = editor.getData();
            });
        })
        .catch((error) => {
            console.error(error);
        });
});

$(document).ready(() => {
    $('#offer_name').on('input', function () {
        $('#offerJobTitle').text($(this).val());
    });
    $('#offer_city').on('input', function () {
        $('#offerCity').text($(this).val());
    });
    $('#offer_contractType').on('input', () => {
        $('#offerContract').text($('#offer_contractType option:selected').text());
    });
});
