let active = false; //false=Voluntario and true=Instituição
let voluntario = document.getElementById("voluntarioInfo");
let instituicao = document.getElementById("instituicaoInfo");
let submit = document.getElementById("submit")
let pai = document.getElementById("main");
let botaoSub = document.getElementById("submit");
document.getElementById("instituicaoInfo").remove();
document.getElementById("radioOne").checked = true;

function main() {
    if(active){
        pai.appendChild(voluntario);
        document.getElementById("submit").remove();
//        pai.appendChild(voluntario);
        document.getElementById("instituicaoInfo").remove();
        pai.appendChild(submit);
        active = false;
    }else{
        pai.appendChild(instituicao);
        document.getElementById("submit").remove();
        document.getElementById("voluntarioInfo").remove();
        pai.appendChild(submit);
        active = true;
    }
}

function alert1(msg){
    setTimeout(function(){alert(msg)}, time);
}