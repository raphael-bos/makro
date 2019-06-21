window.onload = function(){

var boxbueno = document.getElementById("box-bueno").firstElementChild.firstElementChild;
var boxmalo = document.getElementById("box-malo").firstElementChild.firstElementChild;
var boxnormal = document.getElementById("box-normal").firstElementChild.firstElementChild;
var textodespedida = document.getElementById("texto-despedida");

var opinion = document.getElementById("box-opinion");

function clickOpinion (elementId){

    var element = document.getElementById(elementId).firstElementChild.firstElementChild;

    element.addEventListener("click",
    function (event) {

        if(opinion.style.display == "none" || opinion.style.display == "" )
        {
            console.log("if1");
            console.log(opinion.style.display);
            console.log(opinion.style.display);
            opinion.style.display = "inline";
            element.style.backgroundColor = "#B6040C";
            textodespedida.style.margin = "3% auto 5% auto";
        }
        else if(opinion.style.display == "inline")
        {
            //Se o box de escrever opinião estiver aparecendo e a avaliação clicada for vermelho claro
            if(element.style.backgroundColor == "" || element.style.backgroundColor == "rgb(244, 33, 55)")
            {
                //reseta as 3 avaliações para vermelho claro
                boxbueno.style.backgroundColor = "#F42137";
                boxmalo.style.backgroundColor = "#F42137";
                boxnormal.style.backgroundColor = "#F42137";
                //avaliação corrente para vermelho escuro
                element.style.backgroundColor = "#B6040C";
                //mantém o box de escrever opiniao aparecendo e redimensiona a tela
                textodespedida.style.margin = "3% auto 5% auto";
            }
            //se a avaliação estiver vermelho escuro (já clicada)
            else if(element.style.backgroundColor == "rgb(182, 4, 12)")
            {
                element.style.backgroundColor = "#F42137";
                opinion.style.display = "none";
                textodespedida.style.margin = "12% auto 17% auto";
            }                         
        }   
    });

}
clickOpinion("box-bueno");
clickOpinion("box-normal");
clickOpinion("box-malo");

}