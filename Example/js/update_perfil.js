let active = false; //false=form1 and true=form2
let form1 = document.getElementById("form1");
let form2 = document.getElementById("form2");
let edit = document.getElementById("button")
let pai = document.getElementById("pai");
form2.remove();
edit.addEventListener("click",main);


function main() {
    console.log("aaa");
    if(active){
//        pai.appendChild(voluntario);
        form2.remove();
        pai.appendChild(form1);
        active = false;
    }else{
        form1.remove();
        pai.appendChild(form2);
        active = true;
    }
    
}

function myFunction() {
    form1 = form2;
    form2.remove();
    pai.appendChild(form1);
    console.log("!!!!!!!!!!!");
  }