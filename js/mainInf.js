let modal = document.getElementById('miModal');
    let flex = document.getElementById('flex');
    let abrir = document.getElementById('inf');
    let cerrar = document.getElementById('close');

    abrir.addEventListener('click', function(){
        modal.style.display = 'block';
    });

    cerrar.addEventListener('click', function(){
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == flex){
            modal.style.display = 'none';
        }
    });


    //alert(elemento.value);
/*
    $.post(
      "webservice/mostrarInformacionEnvio.php",
      {
        "idPaquete":elemento.value
      },
      function(Data){
        //alert(Data);
        let cliente = JSON.parse(Data);
        document.getElementById("abcd").value = cliente['idEnvio'];
        document.getElementById("nombreCliente").value = cliente['idPaquete'];
        document.getElementById("paquete").value = cliente['descripcion'];
        document.getElementById("cliente").value = cliente['cliente'];
        document.getElementById("Residencia").value = cliente['direccion'];
        document.getElementById("Telefono").value = cliente['telefono'];
        document.getElementById("Ubicacion").value = cliente['ubicacion'];
      }

    );*/


