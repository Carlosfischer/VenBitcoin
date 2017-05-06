var inputs = document.getElementsByClassName('iniciar_sesion__input');
for (var i = 0; i < inputs.length; i++) {
  inputs[i].addEventListener('keyup', function(){
    if(this.value.length>=1) {
      this.nextElementSibling.classList.add('arriba');
    } else {
      this.nextElementSibling.classList.remove('arriba');
    }
  });
}


