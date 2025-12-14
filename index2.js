function clearAll()
{
	let infoTable = document.querySelector('#data');
	infoTable.innerHTML = '';
}

function goToFish() {
    const target_id = document.querySelector('#fish_id_input').value.trim();

    if (target_id === "") {
        alert("Lütfen bir ID girin.");
        return;
    }

    styleLink = document.querySelector('#style');
    let theme = styleLink.getAttribute('href') === './light_theme2.css' ? 'light' : 'dark';
    window.location.href = 'https://balik.yeminlirobot.com/?kayit_id=' + target_id + '&theme=' + theme;
}

// Butona tıklayınca
document.querySelector('#id_search').addEventListener('click', goToFish);

// Tema değiştirme
function changeTheme()
{
    styleLink = document.querySelector('#style');
    styleButton = document.querySelector('#change_theme');
    if (styleLink.getAttribute('href') === './light_theme2.css') {
        styleLink.setAttribute('href', './dark_theme2.css');
        styleButton.textContent = 'Aydınlık Moda Geç';
    }
    else
    {
        styleLink.setAttribute('href', './light_theme2.css');
        styleButton.textContent = 'Karanlık Moda Geç';
    }
}

document.querySelector('#change_theme').addEventListener('click', changeTheme);

// Enter'a basınca
document.querySelector('#fish_id_input').addEventListener('keydown', (event) => {
    if (event.key === "Enter") {
        event.preventDefault(); // form varsa sayfa yenilenmesini engeller
        goToFish();
    }
});