let boton= document.getElementById("formulario")
boton.addEventListener("click",function(event){
  validarFormulario(event)
})



function validarFormulario(event) {
  
  
  let email = document.getElementById("email").value;
  if (email.length == 0) {
    alert("email invalido");
    event.preventDefault();// esto hace que el boton de submit no funcione como normalmente lo hace por lo tanto no se envia los datos
  }
  let contraseña = document.getElementById("contraseña").value;
  if (contraseña.length <= 2) {
    alert("La contraseña no es válida");
    event.preventDefault();
  }
 
}
