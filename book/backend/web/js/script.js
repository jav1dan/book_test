window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {

        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
window.logoutFunction = ()=>{
    let form = document.createElement('form');
    form.method = 'post';
    form.action = '/site/logout';
    let csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_csrf-backend';
    csrf.value = document.querySelector('meta[name="csrf-token"]').content;
    form.append(csrf);
    document.body.append(form);
    form.submit();   
}
$(document).ready(function(){
    $('.main-select select').select2({
        width: '100%'
    });
});
