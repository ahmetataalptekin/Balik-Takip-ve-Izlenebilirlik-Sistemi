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

    window.location.href = "https://balik.yeminlirobot.com/?kayit_id=" + target_id;
}

document.querySelector('#id_search').addEventListener('click', goToFish);

document.querySelector('#fish_id_input').addEventListener('keydown', (event) => {
    if (event.key === "Enter") {
        goToFish();
    }
});