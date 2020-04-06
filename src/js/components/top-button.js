document.addEventListener("DOMContentLoaded", function () {
    const buttonId = 'top-button';
    const activeClass = 'top-button_active';

    let isActive = false;

    let element = document.getElementById(buttonId);

    if (element) {
        document.addEventListener('scroll', (event) => {
            if (document.documentElement.scrollTop >= 300 && !isActive) {
                element.classList.add(activeClass);
            } else {
                element.classList.remove(activeClass);
            }
        });
    }
});