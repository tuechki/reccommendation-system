fetch('navbar.html')
    .then(response => response.text())
    .then(data => {
        document.querySelector('body').insertAdjacentHTML('afterbegin', data);
    });