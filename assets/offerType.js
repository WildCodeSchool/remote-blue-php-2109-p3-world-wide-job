document.addEventListener('DOMContentLoaded', () => {
    window.ClassicEditor
        .create(document.querySelector('#offer_longDescription'))
        .then((editor) => {
            editor.model.document.on('change:data', () => {
                document.getElementById('offerDescription').innerHTML = editor.getData();
            });
        });
});

function changeOutput(inputId, outputId) {
    const input = document.getElementById(inputId);
    input.addEventListener('keyup', () => {
        document.getElementById(outputId).innerHTML = input.value;
    });
}
changeOutput('offer_name', 'offerJobTitle');
changeOutput('offer_city', 'offerCity');

const contractType = document.getElementById('offer_contractType');
contractType.addEventListener('change', () => {
    document.getElementById('offerContract').innerHTML = contractType.selectedOptions[0].label;
});

/*
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
*/
