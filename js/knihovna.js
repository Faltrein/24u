document.getElementById('print').addEventListener('click', function () {
    window.print();
});

document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const data = {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value
    };

    console.log(data);
    fetch('/24u/modules/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(resp => resp.json())
    .then(resp => {
        if (resp.success) {
            window.location.href = '/24u/admin';
        } else {
            alert('Špatné přihlašovací údaje.');
        }
    });
});