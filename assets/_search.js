if (window.matchMedia('(max-width: 992px)').matches) {
    const largeSearchCard = document.getElementById('largeSearchCard');
    const closeOffer = document.getElementById('closeOffer');
    const smallOffers = document.querySelectorAll('.smallOffer');
    smallOffers.forEach((offer) => offer.addEventListener('click', () => {
        largeSearchCard.classList.add('show');
    }));
    closeOffer.addEventListener('click', () => {
        largeSearchCard.classList.remove('show');
    });
}
