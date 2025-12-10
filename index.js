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

// Butona tıklayınca
document.querySelector('#id_search').addEventListener('click', goToFish);

// Enter'a basınca
document.querySelector('#fish_id_input').addEventListener('keydown', (event) => {
    if (event.key === "Enter") {
        event.preventDefault(); // form varsa sayfa yenilenmesini engeller
        goToFish();
    }
});

const currentUrl = window.location.href;

let qrcode = new QRCode(document.getElementById("qrcode"),
{
	text: currentUrl,
	width: 256,
	height: 256
});

document.getElementById('downloadBtn').addEventListener('click', function ()
{
	let canvas = document.querySelector("#qrcode canvas");
	let image = canvas.toDataURL("image/png");

	let link = document.createElement("a");
	link.href = image;
	link.download = "qrcode.png";
	link.click();
});

// QR bölümünü aç/kapa
document.getElementById("qr-toggle").addEventListener("click", () => {
    const content = document.getElementById("qr-content");
    const arrow = document.getElementById("qr-arrow");

    if (content.style.display === "none") {
        content.style.display = "block";
        arrow.textContent = "▲";
    } else {
        content.style.display = "none";
        arrow.textContent = "▼";
    }
});
