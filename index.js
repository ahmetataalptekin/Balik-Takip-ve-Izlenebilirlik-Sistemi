
const dateData = ["14.11.2025", "15.11.2025", "16.11.2025"];
let regionData = ["EGE", "AKDENIZ", "KARADENIZ"];
let typeData = ["CUPRA", "HAMSI", "LEVREK"];
let portData = ["IZMIR LIMANI", "FETHIYE LIMANI", "ISTANBUL LIMANI"];
function randomData(idx) {
  let d = dateData[Math.floor(Math.random() * 3)];
  let r = regionData[Math.floor(Math.random() * 3)];
  let t = typeData[Math.floor(Math.random() * 3)];
  let p = portData[Math.floor(Math.random() * 3)];
  let arr = [d, r, t, p];
  return arr[idx - 1];
}

function clearAll(){
  let infoTable = document.querySelector('#data');
  infoTable.innerHTML = '';
}

function getData() {
  let date = randomData(1);
  let region = randomData(2);
  let fishType = randomData(3);
  let port = randomData(4);

  let newTh = document.createElement('th');
  newTh.textContent = date;
  newTh.scope = 'row';
  let newTd1 = document.createElement('td');
  newTd1.textContent = region;
  let newTd2 = document.createElement('td');
  newTd2.textContent = fishType;
  let newTd3 = document.createElement('td');
  newTd3.textContent = port;

  let infoTable = document.querySelector('#data');
  clearAll();
  infoTable.appendChild(newTh);
  infoTable.appendChild(newTd1);
  infoTable.appendChild(newTd2);
  infoTable.appendChild(newTd3);
}

function sendData() {
  let fish_type = document.querySelector('#fish_type').value;
  let caught_way = document.querySelector('#caught_way').value;
  let caught_place = document.querySelector('#caught_place').value;
  let caught_date = document.querySelector('#caught_date').value;
  let ship_name = document.querySelector('#ship_name').value;
  let ship_id = document.querySelector('#ship_id').value;
  let port_date = document.querySelector('#port_date').value;
  let supplier_name = document.querySelector('#supplier_name').value;
  let supplier_id = document.querySelector('#supplier_id').value;
  let port_name = document.querySelector('#port_name').value;
  fetch("api.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      fish_type: fish_type,
      caught_way: caught_way,
      caught_place: caught_place,
      caught_date: caught_date,
      ship_name: ship_name,
      ship_id: ship_id,
      port_date: port_date,
      supplier_name: supplier_name,
      supplier_id: supplier_id,
      port_name: port_name
    })
  })
  .then(res => res.json())
  .then(data => {
    console.log("PHP Response:", data);

    alert("Veriler PHP'ye gönderildi!");
  })
  .catch(err => {
    console.error("Hata:", err);
  });
}
