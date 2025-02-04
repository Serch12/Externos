<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                position: relative;
                width: 19cm;  
                height: 29.7cm; 
                margin: 0 auto; 
                color: #555555;
                background: #FFFFFF; 
                font-family: Arial, sans-serif; 
                font-size: 14px; 
                font-family: SourceSansPro;
            }
    
            header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
            }
            table {
              border-collapse: collapse;
              width: 100%;
            }
            
            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }
            
            th:nth-child(even) {
              background-color: #dddddd;
            }
            </style>
    </head>
<body>
	<br><br><br>
	<div class="col m12 s12 l12 " style="max-width: 100%;height: auto;">
		<center><a href="https://www.rehabevolution.com"><img src="https://externos-intranet.amfpro.mx/style/logos/logo-_amfpro_pro_color.png" alt="logo" height="15%" width="15%"></a></center>
	</div>
	<br><br>

	<div class="col m12 s12 l12" style="max-width: 100%;height: auto;">
		<center><img src="https://externos-intranet.amfpro.mx/style/logos/password_img2.png" alt="imgfactura" height="20%" width="20%"></center>
	</div>

	<div class="col m12 s12 l12" style="max-width: 100%;height: auto;">
    <center>
      <p>Hola, {{$user->name}}</p>
      <p>Recibimos una solicitud para restablecer tu contraseña.</p>
      <p>
        Para restablecerla, haz clic en el botón de abajo:
      </p>
      <p style="color: green">Si no solicitaste esto, puedes ignorar este mensaje.</p>
    </center>
    
		{{-- <center><h4 style="color: #00B4E5">ENCUESTA DE SATISFACCIÓN. </h4></center> --}}
    <center>

      <a href="{{ $resetUrl }}" 
        style="display: inline-block; padding: 10px 20px; color: #fff; background: #41e500; text-decoration: none; border-radius: 5px; margin-top: 10px;">
        Restablecer Contraseña
    </a>
      <center>
        <p>Gracias,</p>
        <p><strong>El equipo de AMFPro</strong></p>
      </center>
         
      
    </center>
	</div>
</body>
</html>