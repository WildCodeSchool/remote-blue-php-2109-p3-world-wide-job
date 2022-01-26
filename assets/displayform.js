const addItem = (e) => {
    const collectionHolder = document.querySelector(e.currentTarget.dataset.collection);

    const itemForm = document.createElement('div');
    itemForm.classList.add('form-ext');
    itemForm.innerHTML = collectionHolder.dataset.prototype
        .replace(/__name__/g, collectionHolder.dataset.index);
    itemForm.querySelector('.btn-remove').addEventListener('click', () => itemForm.remove());

    collectionHolder.appendChild(itemForm);
    // eslint-disable-next-line no-plusplus
    collectionHolder.dataset.index++;
};

document.querySelectorAll('.btn-new')
    .forEach((btn) => btn.addEventListener('click', addItem));

document.querySelectorAll('.btn-remove')
    .forEach((btn) => btn.addEventListener('click', (e) => e.currentTarget.closest('.itemForm').remove()));
