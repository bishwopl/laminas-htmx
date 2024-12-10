var highlightNavEntryFN = function highlightNavEntry(){
    const currentPath = window.location.pathname;
    document.querySelectorAll('nav a').forEach(link => {
        link.classList.remove('active');
    });
    const currentLink = document.querySelector(`a[href="${currentPath}"]`);
    document.querySelectorAll(`a[href="${currentPath}"]`).forEach(link => {
        link.classList.add('active');
        let parentLink = link.parentElement.closest('.nav-link');
        while (parentLink) {
            parentLink.classList.add('active-link');
            parentLink = parentLink.parentElement.closest('.nav-link');
        }
    });
};

document.body.addEventListener('htmx:afterRequest', highlightNavEntryFN, false);
document.addEventListener('DOMContentLoaded', highlightNavEntryFN, false);
document.body.addEventListener('htmx:afterRequest', function (event) {
    const xhr = event.detail.xhr;
    const statusCode = xhr.status;
    if (xhr.status >= 400 && xhr.status < 600) {
        console.log(`Error: ${statusCode}`);
        document.getElementById('appContent').innerHTML = xhr.responseText;
    }
});
document.body.addEventListener('htmx:sendError', function (event) {
    const xhr = event.detail.xhr;
    const statusCode = xhr.status;
    console.log(`Error: ${statusCode}`);
    alert('Cannot load requested resource !');
});

