document
    .querySelectorAll('[data-bs-toggle="collapse"]')
    .forEach(function (toggleEl) {
        toggleEl.addEventListener('click', toggle)
    })

function toggle(e)
{
    let target = document.querySelector(e.currentTarget.dataset.bsTarget);
    target.classList.toggle('show')
}

