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
    var collection = $(".collapsed");
    var collection1 = $(".filtro");
    collection.each(function() {
        num += 1;
        if ($(this).find("th").text().toLowerCase().includes(texto1)){
            if ($(this).find("#area").text().toLowerCase().includes(texto)){
                altera1.push(num);
            }
        }
    });
    num = 0;
    //////////////////////////777777777777777777777777777
    console.log(collection1);
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
    // console.log(altera1);
    // console.log(altera2);
    // console.log(periodo);
    // console.log(disponibilidade);
    // console.log(collection1.length);
    for(let i=1; i < collection.length+1;i++){
        $("#inst"+i).hide("fast");
    }
    for(let i=0; i < collection.length;i++){
        if(altera1.includes(altera2[i])){
            $("#inst"+altera2[i]).show("fast");
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
        var collection = $(".collapsed");
        // if(disp_bool){
        //     for(let i=1; i < collection.length+1;i++){
        //         $("#"+i).show("slow");
        //     }
        // }
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
        var collection = $(".collapsed");
        // if(prd_bool){
        //     for(let i=1; i < collection.length+1;i++){
        //         $("#volt"+i).show("slow");
        //     }
        // }
    }
}


var inst = [];
function insereVolt_inst(volt){
    inst.push(volt);
}
function criar(){
    

    txtXml = '<?xml version=\'1.0\' encoding=\'UTF-8\'?>'+
					'<instituicoes>';
    for(let i = 0; i < inst.length;i++){
        txtXml += "<instituicao id='"+i+"'> \
                        <nome>"+inst[i][0]+"</nome> \
                        <email>"+inst[i][1]+"</email> \
                        <telefone>"+inst[i][2]+"</telefone> \
                        <morada>"+inst[i][3]+"</morada> \
                        <area>"+inst[i][4]+"</area> \
                        <check2>"+inst[i][5]+"</check2> \
                        <descricao>"+inst[i][6]+"</descricao> \
                        <tipoInst>"+inst[i][7]+"</tipoInst> \
                        <tipoDoa>"+inst[i][8]+"</tipoDoa> \
                        <quantidade>"+inst[i][9]+"</quantidade> \
                        <dia> "+inst[i][10]+"</dia>\
                        <hora> "+inst[i][11]+"</hora>\
                    </instituicao>";
    }
    txtXml += "</instituicoes>";
					
	// console.log(txtXml);
    parser = new DOMParser();
    
    xelem = parser.parseFromString(txtXml,"text/xml");
    return xelem;
}
function teste(dia,hora,id){
    sessionStorage.setItem("dia", dia);
    sessionStorage.setItem("hora", hora);
    sessionStorage.setItem("id_i", id);
    window.location = 'php/insereCheck.php';
}

function cria_inst(){
    xml = criar();
    var inst_nome=xml.getElementsByTagName("nome");
    var inst_email=xml.getElementsByTagName("email");
    var inst_morada=xml.getElementsByTagName("morada");
    var inst_area=xml.getElementsByTagName("area");
    var inst_check2=xml.getElementsByTagName("check");
    var inst_descricao=xml.getElementsByTagName("descricao");
    var inst_tipoInst=xml.getElementsByTagName("tipoInst");
    var inst_tipoDoa=xml.getElementsByTagName("tipoDoa");
    var inst_quantidades=xml.getElementsByTagName("quantidade");
    var inst_telefone=xml.getElementsByTagName("telefone");
    var inst_dia=xml.getElementsByTagName("dia");
    var inst_hora=xml.getElementsByTagName("hora");

   //console.log(voluntarios_nome[0]);
    // console.log(voluntarios_email[0]);
    // console.log(voluntarios_telefone[0]);
    // console.log(voluntarios_area[0]);
    // console.log(voluntarios_dias[0]);
    // console.log(voluntarios_hora[0]);
    // console.log(voluntarios_foto[0]);

    
    for (i=0;i<inst_nome.length;i++) {
        let pai = document.getElementById("teste");
        if (inst[i][12] == 'true'){
        pai.innerHTML += '<tr id="inst'+[i+1]+'"data-toggle="collapse" data-target="#collapse'+i+'" aria-expanded="false" aria-controls="collapse'+i+'" class="collapsed">\
                            <th>'+inst_nome[i].innerHTML+'</th>\
                            <td>'+inst_tipoInst[i].innerHTML+'</td>\
                            <td>'+inst_tipoDoa[i].innerHTML+'</td>\
                            <td id="area">'+inst_area[i].innerHTML+'</td>\
                            <td><i class="fas fa-check" style="color:green;"></i></td>\
                            <td>\
                            <i class="fa" aria-hidden="false"></i>\
                            </td>\
                        </tr>\
                        <tr class="filtro">\
                        <td colspan="6" id="collapse'+i+'" class="collapse acc" data-parent="#accordion">\
                            <p1>'+inst_descricao[i].innerHTML+'</p1>\
                            <hr>\
                            <p1 id="dia">Disponibilidade :' +inst_dia[i].innerHTML+' </p1>\
                            <br>\
                            <p1 id="periodo">Horario:' + inst_hora[i].innerHTML +' </p1>\
                            <br><p1>Quantidade prevista: '+inst_quantidades[i].innerHTML+' kg</p1> <hr> <p1>Email:'+inst_email[i].innerHTML+'</p1>\
                            <br>\
                            <p1>Telefone: '+inst_telefone[i].innerHTML+'</p1>\
                            <br>\
                            <p1>Morada : '+inst_morada[i].innerHTML+'</p1>\
                            <hr>\
                            <p1><button id = "button2" onclick="teste('+inst_dia[i].innerHTML+','+ inst_hora[i].innerHTML +','+inst[i][12]+')"class="btn"><span>Desinscrever</span><img src="https://i.cloudup.com/2ZAX3hVsBE-3000x3000.png" height="20" width="20"></button></p1>\
                            <br>\
                            <div class="col-6 contact-info"> \
                                	<h6 class="mb-3"><a href="chat_app.php">Chat</a></h6> \
                                </div> \
                            <br>\
                        </td>\
                        </tr>' ;}
        else{
            pai.innerHTML += '<tr data-toggle="collapse" data-target="#collapse'+i+'" aria-expanded="false" aria-controls="collapse'+i+'" class="collapsed">\
                            <th>'+inst_nome[i].innerHTML+'</th>\
                            <td>'+inst_tipoInst[i].innerHTML+'</td>\
                            <td>'+inst_tipoDoa[i].innerHTML+'</td>\
                            <td id="area">'+inst_area[i].innerHTML+'</td>\
                            <td><i class="fas fa-xmark" style="color:red;"></i></td>\
                            <td>\
                            <i class="fa" aria-hidden="false"></i>\
                            </td>\
                        </tr>\
                        <tr>\
                        <td colspan="6" id="collapse'+i+'" class="collapse acc" data-parent="#accordion">\
                            <p1>'+inst_descricao[i].innerHTML+'</p1>\
                            <hr>\
                            <p1 id="dia">Disponibilidade :' +inst_dia[i].innerHTML+' </p1>\
                            <br>\
                            <p1 id="periodo">Horario:' + inst_hora[i].innerHTML +' </p1>\
                            <br><p1>Quantidade prevista: '+inst_quantidades[i].innerHTML+' kg</p1> <hr> <p1>Email:'+inst_email[i].innerHTML+'</p1>\
                            <br>\
                            <p1>Telefone: '+inst_telefone[i].innerHTML+'</p1>\
                            <br>\
                            <p1>Morada : '+inst_morada[i].innerHTML+'</p1>\
                            <hr>\<p1><button id = "button1" class="btn"><span>Inscrever</span><img src="https://i.cloudup.com/2ZAX3hVsBE-3000x3000.png" height="20" width="20"></button></p1>\
                            <br> \
                            <div class="col-6 contact-info"> \
                                	<h6 class="mb-3"><a href="chat_app.php">Chat</a></h6> \
                                </div> \
                            <br>\
                        </td>\
                        </tr>' ;
                    }                     
    }
        
}
