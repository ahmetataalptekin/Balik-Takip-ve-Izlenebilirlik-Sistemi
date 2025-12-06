function clearAll()
{
	let infoTable = document.querySelector('#data');
	infoTable.innerHTML = '';
}
function open_link()
{
	let target_id = document.querySelector('#fish_id_input').value;
	document.querySelector('#id_search').onclick = function ()
	{
		window.location.href = "https://balik.yeminlirobot.com/?kayit_id=" + target_id;
	}
}