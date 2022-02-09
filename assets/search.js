require('select2');

const largeOffers = document.getElementsByClassName('largeOffer');
const smallOffers = document.getElementsByClassName('smallOffer');
const closeOffer = document.getElementsByClassName('closeOffer');
const applyButtons = document.querySelectorAll('[data-apply]');
const addFavorite = document.querySelectorAll('[data-favorite]');
const filters = document.getElementById('filter-bar');
const openFilters = document.getElementById('open-filter');
const closeFilters = document.getElementById('closeFilters');
const closeSearch = document.getElementById('filter_offer_submit');
const $ = require('jquery');

document.addEventListener('DOMContentLoaded', () => {
    $('.select-multiple').select2();
});

function addToFavorite(event) {
    event.preventDefault();
    const favoriteLink = event.currentTarget;
    const link = favoriteLink.href;
    fetch(link)
        .then((res) => res.json())
        .then((res) => {
            if (res.isInFavorite) {
                // Ajout d'un message au clic si possible
                favoriteLink.innerHTML = 'Retirer';
                favoriteLink.classList.remove('btn-primary');
                favoriteLink.classList.add('btn-success');
            } else {
                favoriteLink.classList.add('btn-primary');
                favoriteLink.classList.remove('btn-success');
                favoriteLink.innerHTML = 'Enregistrer';
            }
        });
}

function jobApply(event) {
    event.preventDefault();
    const applyLink = event.currentTarget;
    const link = applyLink.href;
    fetch(link)
        .then((res) => res.json())
        .then((res) => {
            if (res.isApplied) {
                // eslint-disable-next-line no-alert
                alert('Vous avez déjà postulé');
            } else {
                applyLink.innerHTML = 'Postulé';
                // eslint-disable-next-line
                applyLink.outerHTML = '<p class=\'btn-success text-white text-center rounded descApply\'>' + applyLink.innerHTML + '</p>';
            }
        });
}
applyButtons.forEach((element) => element.addEventListener('click', jobApply));

function load1stContent(array, array2) {
    array[0].classList.add('show');
    array2[0].classList.add('active');
}
if (window.matchMedia('(min-width: 992px)').matches) {
    load1stContent(largeOffers, smallOffers);
}
// eslint-disable-next-line no-restricted-syntax
for (const element of smallOffers) {
    element.addEventListener('click', (event) => {
        const selectedId = (event.target.id).substring(10);
        // eslint-disable-next-line no-restricted-syntax
        for (const clicked of smallOffers) {
            clicked.classList.remove('active');
        }
        element.classList.add('active');
        // eslint-disable-next-line no-restricted-syntax
        for (const offer of largeOffers) {
            if (window.matchMedia('(min-width: 992px)').matches) {
                offer.classList.remove('show');
            }
            const divId = offer.id.substring(10);
            if (divId === selectedId) {
                offer.classList.add('show');
            }
            if (window.matchMedia('(max-width: 992px)').matches) {
                // eslint-disable-next-line no-restricted-syntax
                for (const close of closeOffer) {
                    close.addEventListener('click', () => {
                        offer.classList.remove('show');
                    });
                }
            }
        }
    });
}

addFavorite
    .forEach((a) => a.addEventListener('click', addToFavorite));

openFilters.addEventListener('click', () => {
    filters.classList.add('show');
});

closeSearch.addEventListener('click', () => {
    filters.classList.remove('show');
});

closeFilters.addEventListener('click', () => {
    filters.classList.remove('show');
});
