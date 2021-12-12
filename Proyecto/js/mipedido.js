

document.getElementById("form__btn").addEventListener('click', guardar);

document.getElementById("editarDireccion--btn").addEventListener('click', editar);


function guardar(){
    document.getElementById("editarDireccion--form").style.display="none";
    document.getElementById("direccion--div").style.display="block";
}



function editar(){
    document.getElementById("editarDireccion--form").style.display="block";
    document.getElementById("direccion--div").style.display="none";
}



document.getElementById("editarDireccion--btn").addEventListener('click',function(e){
    document.getElementById("editarDireccion--form").style.display="block";
});

