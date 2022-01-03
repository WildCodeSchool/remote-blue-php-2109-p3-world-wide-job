const largeOffers = document.getElementsByClassName('largeOffer');
const smallOffers = document.getElementsByClassName('smallOffer');
const closeOffer = document.getElementsByClassName('closeOffer');
function load1stContent(array) {
    array[0].classList.add('show');
}
if (window.matchMedia('(min-width: 992px)').matches) {
    window.onload = load1stContent(largeOffers);
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
