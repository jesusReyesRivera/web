function enviar(){
  var Nombre = document.getElementById('usuario').value;
   var contra = document.getElementById('password').value;
  if(Nombre!="" && contra!=""){
$.ajax({
type: 'POST',
url: "./sesion/admin.php",
data: {

  usuario: document.getElementById('usuario').value,
  password: document.getElementById('password').value
}

}).done(function(res){
  if(res=="1"){
    location.href="admin/";
  }
  else{
    alert("Usuario o password erroneo");
  }
});
}
else{
  alert("Usuario o password en blanco!!");
}
}
