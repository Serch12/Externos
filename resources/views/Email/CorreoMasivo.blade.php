<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pruebas </title>
</head>
<body>
    <center>
        {{-- @foreach($img as $key => $value)
            <img src="https://externos-intranet.amfpro.mx/ArchivosSistema/GaleriaCorreo/{{$value['nombre']}}" alt="Img" width="60%">
        @endforeach --}}
        <img src="https://externos-intranet.amfpro.mx/style/logos/fondo2.jpg" alt="Img" width="60%">
        {{-- <p>
            Te compartimos una oferta clave para tu desarrollo fuera del campo, contamos con una alianza entre la #AMFpro y el Instituto #JohanCruyff para cursar el Máster Internacional en Negocios y Administración del Futbol ⚽.
            Checa toda la información en el siguiente link <a href="https://goo.su/DEx1MAb">https://goo.su/DEx1MAb</a> y mándanos un correo electrónico a desarrolloeducativo@amfpro.mx para apoyarte con cualquier duda.
        </p> --}}
        <p>{!! $correo['informacion'] !!}</p>
    </center>
</body>
</html>