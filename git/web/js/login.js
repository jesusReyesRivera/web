function enviar(){
  var Nombre = document.getElementById('usuario').value;
   var contra = document.getElementById('password').value;
  if(Nombre!="" && contra!=""){
$.ajax({
type: 'POST',
url: "./sesion/login.php",
data: {

  usuario: document.getElementById('usuario').value,
  password: document.getElementById('password').value
}

}).done(function(res){
  if(res=="0"){
    location.href="inicio/";
  }
  else if(res=="0-0"){
    alert("usuario inactivo");
  }else{
    alert("Usuario o password erroneo");
  }
});
}
else{
  alert("Usuario o password en blanco!!");
}
}
