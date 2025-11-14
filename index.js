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
