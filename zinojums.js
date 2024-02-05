document.getElementById('forma').addEventListener('submit', function(event) {
    event.preventDefault(); // Novērš lapas atsvaidzināšanu
    var vards = document.getElementById('vards').value;
    var zinojums = document.getElementById('zinojums').value;
    document.getElementById('rezultats').innerText = 'Vārds: ' + vards + ', Ziņojums: ' + zinojums;
  });