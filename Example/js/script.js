// const table = document.getElementById("myTable");
// save all tr
console.log('ola');
// const tr = table.getElementsByTagName("tr");

function SearchData() {
    console.log(document.getElementById("segunda").value);
    
  var name = document.getElementById("idName").value.toUpperCase();
  var freguesia = document.getElementById("idfreguesia").value.toUpperCase();
  var concelho = document.getElementById("idconcelho").value.toUpperCase();
  var disponiblidade = document.getElementById("iddisponiblidade").value.toUpperCase();
  var horas = document.getElementById("idhoras").value.toUpperCase();

  for (i = 1; i < tr.length; i++) {

    var rowName = tr[i].getElementsByTagName("td")[0].textContent.toUpperCase();
    var rowfreguesia = tr[i].getElementsByTagName("td")[1].textContent.toUpperCase();
    var rowconcelho = tr[i].getElementsByTagName("td")[2].textContent.toUpperCase();
    var rowdisponiblidade = tr[i].getElementsByTagName("td")[3].textContent.toUpperCase();
    var rowhoras = tr[i].getElementsByTagName("td")[4].textContent.toUpperCase();

    var isDiplay = true;

    if (name != 'ALL' && rowName != name) {
      isDiplay = false;
    }
    if (freguesia != 'ALL' && rowfreguesia != freguesia) {
      isDiplay = false;
    }
    if (concelho != 'ALL' && rowconcelho != concelho) {
      isDiplay = false;
    }
    if (disponiblidade != 'ALL' && rowdisponiblidade != disponiblidade) {
      isDiplay = false;
    }
    if (horas != 'ALL' && rowhoras != horas) {
      isDiplay = false;
    }
    
    if (isDiplay) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }


  }
}
 
