profileIcon = document.querySelector('main .container-fluid .row .col-xl-10 .user-profile-header img');
logoutSection = document.querySelector('main .container-fluid .row .col-xl-10 .logout-section');

profileIcon.addEventListener('click', () => {
    logoutSection.classList.toggle('block');
})