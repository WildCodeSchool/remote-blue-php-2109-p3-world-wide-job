const acceptButtons = document.querySelectorAll('[data-accept]');
const refuseButton = document.querySelectorAll('[data-refuse]');
const refuseButtonId = document.getElementById('btn-refuse-id');
const acceptButtonId = document.getElementById('btn-accept-id');

function acceptCandidate(event)
{

    event.preventDefault();
    // eslint-disable-next-line no-use-before-define
    const acceptLink = event.currentTarget;
    const link = acceptLink.href;
    fetch(link)
        .then((res) => res.json())
        .then((res) => {
            if (res.isAccept === true) {
                const acceptLabel = document.getElementById('acceptLabel' + acceptLink.dataset.accept);
                const refuseBtn = document.getElementById('btn-refuse-' + acceptLink.dataset.accept);
                const labelResult = document.getElementById('label-result-' + acceptLink.dataset.accept);
                const label = document.getElementById('waiting-' + acceptLink.dataset.accept);
                acceptLabel.classList.remove('d-none');
                acceptLink.classList.add('d-none');
                refuseBtn.classList.add('d-none');
                labelResult.innerHTML =  "Accepté(e)";
                labelResult.classList.add('alert-success');
                label.classList.add('d-none');
            }
        });
}

function refuseCandidate(event)
{
    event.preventDefault();
    const refuseLink = event.currentTarget;
    const link = refuseLink.href;
    fetch(link)
        .then((res) => res.json())
        .then((res) => {
            if (res.isRefuse === true) {
                const refuseLabel = document.getElementById('refuseLabel' + refuseLink.dataset.refuse);
                const acceptBtn = document.getElementById('btn-accept-' + refuseLink.dataset.refuse);
                const labelResult = document.getElementById('label-result-' + refuseLink.dataset.refuse);
                const label = document.getElementById('waiting-' + refuseLink.dataset.refuse);
                refuseLabel.classList.remove('d-none');
                acceptBtn.classList.add('d-none');
                refuseLink.classList.add('d-none');
                labelResult.innerHTML = "Refusée";
                labelResult.classList.add('alert-danger');
                label.classList.add('d-none');
            }
        });
}

acceptButtons.forEach((element) => element.addEventListener('click', acceptCandidate));
refuseButton.forEach((element) => element.addEventListener('click', refuseCandidate));
