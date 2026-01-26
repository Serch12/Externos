<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro - AMFpro</title>
    <style>
        /* Estilos base para compatibilidad */
        body { font-family: 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f4f7f6; margin: 0; padding: 0; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; margin-top: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background-color: #2b7a3a; padding: 30px; text-align: center; color: white; }
        .content { padding: 40px; text-align: center; line-height: 1.6; color: #333333; }
        .qr-box { background-color: #f8f9fa; border: 2px dashed #82f111; padding: 20px; display: inline-block; border-radius: 12px; margin: 20px 0; }
        .footer { background-color: #f8f9fa; padding: 20px; text-align: center; font-size: 12px; color: #777777; }
        .btn { background-color: #82f111; color: #000; padding: 12px 25px; text-decoration: none; font-weight: bold; border-radius: 5px; display: inline-block; margin-top: 20px; }
        .text-neon { color: #82f111; font-weight: 800; }
        .badge { background: #2b7a3a; color: white; padding: 5px 12px; border-radius: 20px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin:0; font-size: 28px;">AMF<span class="text-neon">PRO</span></h1>
            <p style="margin:5px 0 0; opacity: 0.8; letter-spacing: 1px;">#UnidosSomosMásFuertes</p>
        </div>

        <div class="content">
            <h2 style="color: #2b7a3a;">¡Hola, {{ $registro->nombre }}!</h2>
            <p>Tu registro para las <strong>Visorias 2026</strong> se ha completado con éxito. Estamos emocionados de verte en la cancha.</p>
            
            <div class="badge">ID de Registro: #{{ $registro->id }}</div>

            <p style="margin-top: 25px;">Presenta el siguiente código QR desde tu celular al momento de llegar para validar tu asistencia:</p>

            <div class="qr-box">
                <img src="{{ $qrCodeUrl }}" alt="Código QR de Registro" style="width: 200px; height: 200px; display: block;">
            </div>

            <p style="font-size: 14px; color: #666;">
                <strong>Ubicación:</strong> {{ $registro->lugar_visoria }}<br>
                <strong>Categoría:</strong> {{ $registro->posicion }} ({{ $registro->perfil }})
            </p>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

            <p style="font-size: 13px;">Recuerda llevar tu uniforme completo, hidratación y tu formato firmado.</p>
        </div>

        <div class="footer">
            <p>© 2026 Asociación Mexicana de Futbolistas Profesionales (AMFpro)</p>
            <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
            <div style="margin-top: 10px;">
                <a href="#" style="color: #2b7a3a; text-decoration: none; margin: 0 5px;">Facebook</a> | 
                <a href="#" style="color: #2b7a3a; text-decoration: none; margin: 0 5px;">Instagram</a> | 
                <a href="#" style="color: #2b7a3a; text-decoration: none; margin: 0 5px;">Twitter</a>
            </div>
        </div>
    </div>
</body>
</html>