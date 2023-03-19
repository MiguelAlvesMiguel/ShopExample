function inicio(){
    document.getElementById('txt_input1').addEventListener('keyup', procurar);
    document.getElementById('txt_input').addEventListener('keyup', procurar);
    disp_op = document.getElementById('disponibilidade_op');
    prd_op = document.getElementById('periodo_op');
    document.getElementById('disponibilidade_op').remove();
    document.getElementById('periodo_op').remove();
}
var collection2;
let disp_op;
let prd_op
let disp_bool = true;
let prd_bool = true;
var periodo = ['manha'];
var disponibilidade = ['segunda'];

function procurar(){
    let texto1 = document.getElementById("txt_input1").value.toLowerCase();
    let texto = document.getElementById("txt_input").value.toLowerCase();
    let altera1 = [];
    let altera2 = [];
    let num = 0;
    var collection = $(".voluntario");
    var collection1 = $(".voluntario_info");
    collection.each(function() {
        num += 1;
        if ($(this).find("h5").text().toLowerCase().includes(texto1)){
            if ($(this).find("strong").text().toLowerCase().includes(texto)){
                altera1.push(num);
            }
        }
    });
    num = 0;
    //////////////////////////777777777777777777777777777
    collection1.each(function() {
        num += 1;
        console.log($(this).find("#dia").text().toLowerCase());
        console.log(disponibilidade[0]);
        console.log($(this).find("#dia").text().toLowerCase().includes(disponibilidade[0]));
        if ($(this).find("#periodo").text().toLowerCase().includes(periodo[0])){
            if ($(this).find("#dia").text().toLowerCase().includes(disponibilidade[0])){
                altera2.push(num);
                console.log(altera2);
            }
        }
    });
    console.log(altera1);
    console.log(altera2);
    console.log(periodo);
    console.log(disponibilidade);
    console.log(collection1.length);
    for(let i=1; i < collection.length+1;i++){
        $("#volt"+i).hide("fast");
    }
    for(let i=0; i < collection.length;i++){
        if(altera1.includes(altera2[i])){
            $("#volt"+altera2[i]).show("fast");
        }
    }
}

function registoPeriodo(msg){
    periodo.pop();
    periodo.push(msg);
    procurar();
}

function registoDisponibilidade(msg){
    disponibilidade.pop();
    disponibilidade.push(msg);
    procurar();
}
function inserirRetirarPeriodo(){
    let pai = document.getElementById('periodo');
    if(prd_bool){
        pai.appendChild(prd_op);
        prd_bool = false;
    }else{
        prd_op.remove();
        prd_bool = true;
        var collection = $(".voluntario");
        if(disp_bool){
            for(let i=1; i < collection.length+1;i++){
                $("#volt"+i).show("fast");
            }
        }
    }
    
}
function inserirRetirarDisponibilidade(){
    let pai = document.getElementById('disponibilidade');
    var collection = $("#radio");
    console.log('ola');
    collection.each(function() {
        console.log($(this));
    });
    if(disp_bool){
        pai.appendChild(disp_op);
        disp_bool = false;
    }else{
        disp_op.remove();
        disp_bool = true;
        var collection = $(".voluntario");
        if(prd_bool){
            for(let i=1; i < collection.length+1;i++){
                $("#volt"+i).show("slow");
            }
        }
    }
}


var voluntarios = [];
function insereVolt(volt){
    voluntarios.push(volt);
}
function criar(){
    
    // console.log(msg);

    txtXml = '<?xml version=\'1.0\' encoding=\'UTF-8\'?>'+
					'<voluntarios>';
    for(let i = 0; i < voluntarios.length;i++){
        txtXml += "<voluntario id='"+voluntarios[i][0]+"'> \
                        <nome>"+voluntarios[i][1]+"</nome> \
                        <telefone>"+voluntarios[i][2]+"</telefone> \
                        <email>"+voluntarios[i][3]+"</email> \
                        <genero>"+voluntarios[i][4]+"</genero> \
                        <CC>"+voluntarios[i][5]+"</CC> \
                        <cartaConducao>"+voluntarios[i][6]+"</cartaConducao> \
                        <morada> \
                            <distrito>"+voluntarios[i][7]+"</distrito> \
                            <concelho>"+voluntarios[i][8]+"</concelho> \
                            <freguesia>"+voluntarios[i][9]+"</freguesia> \
                        </morada> \
                        <foto>"+voluntarios[i][10]+"</foto> \
                        <area>"+voluntarios[i][11]+"</area> \
                        <dias>"+voluntarios[i][12]+"</dias> \
                        <hora>"+voluntarios[i][13]+"</hora> \
                    </voluntario>";
    }
    txtXml += "</voluntarios>";
					
	
    parser = new DOMParser();
    
    xelem = parser.parseFromString(txtXml,"text/xml");
    return xelem;
}


function cria_voluntario(){
    xml = criar();
    var voluntarios_nome=xml.getElementsByTagName("nome");
    var voluntarios_email=xml.getElementsByTagName("email");
    var voluntarios_telefone=xml.getElementsByTagName("telefone");
    var voluntarios_area=xml.getElementsByTagName("area");
    var voluntarios_dias=xml.getElementsByTagName("dias");
    var voluntarios_hora=xml.getElementsByTagName("hora");
    var voluntarios_foto=xml.getElementsByTagName("foto");
    

    // console.log(voluntarios_nome[0]);
    // console.log(voluntarios_email[0]);
    // console.log(voluntarios_telefone[0]);
    // console.log(voluntarios_area[0]);
    // console.log(voluntarios_dias[0]);
    // console.log(voluntarios_hora[0]);
    // console.log(voluntarios_foto[0]);
    for (i=1;i<voluntarios_nome.length+1;i++) {
        let pai = document.getElementById("pai");
        let pai_info = document.getElementById("pai_info");
        let nome = voluntarios_nome[i-1].innerHTML
        let primeiro = nome.split(' ')[0];
        let utltimo = nome.split(' ')[1];
        pai.innerHTML += "<div class='col-lg-4 mb-4 col-12 voluntario' id='volt"+i+"'> \
                            <div class='team-thumb d-flex align-items-center'> \
                                <img src='images/people/"+voluntarios_foto[i-1].innerHTML+"' class='img-fluid custom-circle-image team-image me-4' alt=''> \
                                <div class='team-info'> \
                                    <h5 class='mb-0'>"+primeiro+"<br>"+utltimo+"</h5> \
                                    <strong class='text-muted'>"+voluntarios_area[i-1].innerHTML+"</strong> \
                                    <button type='button' class='btn custom-modal-btn' data-bs-toggle='modal' data-bs-target='#volt_info"+i+"'> \
                                    <i class='bi-plus-circle-fill'></i>\
                                    </button> \
                                </div> \
                            </div> \
                        </div>";
        
        pai_info.innerHTML += " <div class='modal fade voluntario_info' id='volt_info"+i+"' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'> \
                                    <div class='modal-dialog modal-dialog-centered modal-lg'> \
                                        <div class='modal-content border-0'> \
                                            <div class='modal-header flex-column'> \
                                                <h3 class='modal-title' id='exampleModalLabel'>"+voluntarios_nome[i-1].innerHTML+"</h3> \
                                                <h6 class='text-muted'>"+voluntarios_area[i-1].innerHTML+"</h6> \
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button> \
                                            </div> \
                                            <div class='modal-body'> \
                                                <h5 class='mb-4'>Disponibilidade</h5> \
                                                <div class='row mb-4'> \
                                                    <div class='col-lg-6 col-12'> \
                                                        <p id='dia'>Dia:"+voluntarios_dias[i-1].innerHTML+"</p> \
                                                    </div> \
                                                    <div class='col-lg-6 col-12'> \
                                                        <p id='periodo'>Periodo:"+voluntarios_hora[i-1].innerHTML+"</p> \
                                                    </div> \
                                                </div> \
                                            </div> \
                                            <div class='modal-body'> \
                                                <h5 class='mb-4'>Contacto</h5> \
                                                <div class='row mb-4'> \
                                                    <div class='col-lg-6 col-12'> \
                                                        <p id ='telefone'>Telefone:"+voluntarios_telefone[i-1].innerHTML+" </p> \
                                                    </div> \
                                                    <div class='col-lg-6 col-12'> \
                                                        <p id='email'>Email: "+voluntarios_email[i-1].innerHTML+"</p> \
                                                    </div> \
                                                </div> \
                                            </div> \
                                        </div> \
                                    </div> \
                                </div>";
                                   
    }
    collection2 = $(".voluntario_info");
}