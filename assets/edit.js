const closeAlert = document.getElementById('btnEditClose');
const alert = document.getElementById('alertEdit');
closeAlert.addEventListener('click', () => {
    alert.classList.add('none');
});
