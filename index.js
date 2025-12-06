function clearAll()
{
	let infoTable = document.querySelector('#data');
	infoTable.innerHTML = '';
}

document.querySelector('#id_search').addEventListener('click', () => {
    const target_id = document.querySelector('#fish_id_input').value.trim();

    console.log("Target ID:", target_id);

    if (target_id === "") {
        alert("Lütfen bir ID girin.");
        return;
    }

    window.location.href = "https://balik.yeminlirobot.com/?kayit_id=" + target_id;
});