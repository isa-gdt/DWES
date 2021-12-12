window.onload = function init(){

    document.getElementById("carrito--btn").addEventListener('click',carrito);
    document.getElementById("carrito--close__btn").addEventListener('click',close);

    function carrito() {
        
        document.getElementById("carrito").style.visibility="visible";
	    document.getElementById("fondo").style.display="block";  
    }

    function close(){
	    document.getElementById("carrito").style.visibility="hidden";
	    document.getElementById("fondo").style.display="none";  
    }      
}


