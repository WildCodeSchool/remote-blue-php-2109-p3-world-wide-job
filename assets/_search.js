if (window.matchMedia('(max-width: 992px)').matches) {
    const openOffer = document.getElementsByClassName('smallOffer');
    const largeSearchCard = document.getElementsByClassName('largeSearchCard');
    const closeOffer = document.getElementsByClassName('closeOffer');

    openOffer.addEventListener('click', () => {
        largeSearchCard.classList.add('show');
    });

    closeOffer.addEventListener('click', () => {
        largeSearchCard.classList.remove('show');
    });
}
