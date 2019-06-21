window.onload = function(){
    
    var grid = document.getElementsByClassName("grid");
    var grid_ofertas = document.querySelector('.grid-ofertas');    
    var oferta = document.getElementsByClassName("oferta");
    var boxOfertas = document.getElementsByClassName("box-ofertas");
    var gridOfertas = document.getElementsByClassName("grid-ofertas");
    var descargar = document.getElementById("box-descargar");    
    var continuarsindesc = document.getElementById("box-continuarsindesc");
    var retornar = document.getElementById("box-retornar");
    var correo = document.getElementById("box-correo");
    var correoConfirma = document.getElementById("box-correoconfirma");
    var codigoqr = document.getElementById("box-codigoqr");
    var fotocodigoqr = document.getElementById("box-fotocodigoqr");
    var retornarFim = document.getElementById("box-retornarfim");
    var continuar = document.getElementById("box-continuar");
    var template = "";

    //consumo da API
    const userAction = async () => {        
    
        fetch('/totem/api/produto.php?action=search')
        .then(response => response.json().then(data => ({
                data: data,
                status: response.status
            })
        ).then(res => {
            console.log(res);
            console.log(res.data);
            let listaOfertas = res.data;    
    
            for(var i = 0; i < listaOfertas.length; i++){
                var oferta = listaOfertas[i];
                console.log("AAAAAAAAAAAAA " + oferta.id);

                var id = oferta.id;
                var nomeOferta = oferta.name;
                var descricaoOferta = oferta.description;
                var dataOferta = oferta.dateOffer;
                var preco = oferta.price;
                var unidadePrefixo = oferta.unitPrefix;
                var imagem = oferta.image;

                //console.log(id + nomeOferta + descricaoOferta + dataOferta + preco + unidadePrefixo + imagem);
                
                template += 
                "<div class='oferta'><img class='img-oferta'" + " src=" + imagem + ">" +
                    "<span class='titulo-oferta'>" + nomeOferta + "</span>" + 
                    "<span class='descricao-oferta'>" + descricaoOferta + "</span>" +
                        "<div class='container-prazo-preco'>" +                            
                            "<span class='prazo-oferta'>" + "Até " + dataOferta + "</span>" +
                            "<div class='container-preco'>" +                 
                                "<span class='preco-oferta'>" + "$" + preco + "</span>" +                 
                                "<span class='unidade-oferta'>" + unidadePrefixo + "</span>" +
                            "</div>" +
                        "</div>" + 
                 "</div>";  
    }
    var render = function (template, node) {
              	if (!node) return;
              	node.innerHTML = template;
              };

    render(template, document.querySelector('.box-ofertas'));    
    

        }));
      }

userAction();

descargar.addEventListener("click",
    function (event) {    
        if(continuarsindesc.style.display == "" || continuarsindesc.style.display == "flex")
        {        
            setClassHeight(oferta, "43.2%");
            grid_ofertas.style.height = "43.2%";
            setClassHeight(boxOfertas, "79%");
            setClassHeight(gridOfertas, "45.9%");
            setClassHeight(grid, "49%");               
            continuarsindesc.style.display = "none";
            retornar.style.flexBasis = "49%";       
            descargar.style.flexBasis = "49%";
            descargar.style.backgroundColor = "#B6040C";
            correo.style.display = "flex";
            codigoqr.style.display = "flex";        
        }    
        else if(continuarsindesc.style.display == "none") 
        {
            setClassHeight(oferta, "24.2%");
            setClassHeight(boxOfertas, "85.9%");
            setClassHeight(gridOfertas, "74.19%");
            setClassHeight(grid, "");
            retornar.style.flexBasis = "32.4%";
            descargar.style.flexBasis = "32.4%";
            descargar.style.backgroundColor = "#F42137";
            continuarsindesc.style.display = "flex";
            correo.style.display = "none";
            correo.style.backgroundColor = "#F42137"
            codigoqr.style.display = "none";
            codigoqr.style.backgroundColor = "#F42137"
            fotocodigoqr.style.display = "none";
            correoConfirma.style.display = "none";            
            grid_ofertas.style.display = "block";
            retornarFim.style.display = "none";
            continuar.style.display = "none";
        }    
           });

function clickCorreoOrCodigoQR (elementId){

    var element = document.getElementById(elementId);

    element.addEventListener("click",
    function (event) { 
            
        
            if((correoConfirma.style.display == "flex" || 
            fotocodigoqr.style.display == "flex") && 
            element.style.backgroundColor == "rgb(182, 4, 12)")
            {
                fotocodigoqr.style.display = "none";
                correoConfirma.style.display = "none";
                retornarFim.style.display = "none";
                continuar.style.display = "none";
                grid_ofertas.style.display = "block";                
                setClassHeight(grid, "49%");
                element.style.backgroundColor = "#F42137";
            }
            else{                    
            element.style.backgroundColor = "#B6040C";
            descargar.style.backgroundColor = "#F42137";
            if(elementId == "box-correo")
            {                
                codigoqr.style.backgroundColor = "#F42137";               
                correoConfirma.style.display = "flex";
                fotocodigoqr.style.display = "none";                              
            }
            else if(elementId == "box-codigoqr")
            {
                correo.style.backgroundColor = "#F42137";                
                fotocodigoqr.style.display = "flex";
                correoConfirma.style.display = "none";
            }
            grid_ofertas.style.display = "none";
            setClassHeight(grid, "94.7%");
            retornarFim.style.display = "flex";
            continuar.style.display = "flex";        
        }
        
    });
}

clickCorreoOrCodigoQR("box-codigoqr");
clickCorreoOrCodigoQR("box-correo");

        function setClassHeight (classElements, heightValue) 
        {
            var arrayElements = Object.entries(classElements);
        for(var i = 0; i< arrayElements.length; i++) {
            arrayElements[i][1].style.height = heightValue;
        }

        }




}