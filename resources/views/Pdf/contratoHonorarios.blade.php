<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contrato de Prestación de Servicios Profesionales</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 9pt; /* Ligeramente más pequeño para todo el documento */
            margin: 30px; /* Margen al documento */
            position: relative; /* Necesario para el posicionamiento absoluto del logo en la impresión */
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Roboto', sans-serif;
            text-align: center; /* Centrar todos los encabezados */
        }
        p {
            font-family: 'Roboto', sans-serif;
            text-align: justify; /* Justificar texto para mejor legibilidad */
            margin-bottom: 0.5em; /* Espacio reducido entre párrafos */
            margin-top: 0.5em; /* Espacio reducido entre párrafos */
        }
        .text-center {
            text-align: center;
        }
        .firma-area {
            font-family: 'Roboto', sans-serif;
            margin-top: 3em;
            width: 100%;
            display: table; /* Use table display for better cross-browser signature alignment */
        }
        .signature-block {
            display: table-cell; /* Each signature block is a table cell */
            width: 50%; /* Each takes half the width */
            text-align: center;
            vertical-align: bottom; /* Align signatures at the bottom */
            padding: 0 20px; /* Add some padding between signatures and margins */
        }
        .signature-img {
            width: 100px; /* Ancho máximo para la imagen de la firma */
            height: 50px; /* Altura máxima para la imagen de la firma */
            object-fit: contain; /* Asegura que la imagen se ajuste sin recortarse */
            display: block; /* Asegura que se comporte como un bloque para el espaciado */
            margin: 0 auto; /* Asegura que la imagen esté centrada horizontalmente */
        }
        .firma-line {
            border-bottom: 1px solid black;
            width: 80%; /* Adjust width of the signature line */
            margin: 0 auto 5px auto; /* Center the line and add space below */
        }

        pre p { /* Asegura que los párrafos dentro de pre sean justificados */
            text-align: justify;
        }

        pre {
            white-space: pre-wrap;
            font-family: 'Roboto', serif;
            font-size: 9pt; /* Tamaño de fuente específico para el cuerpo del contrato */
            margin: 0;
            padding: 0;
            text-align: justify; /* Justificar el texto principal del contrato */
        }

        .header-table {
            width: 100%;
            border-collapse: collapse; /* Para eliminar espacios entre celdas */
            margin-bottom: 20px; /* Espacio debajo del encabezado */
        }
        .header-table td {
            vertical-align: top; /* Alinea el contenido de las celdas en la parte superior */
            padding: 0; /* Elimina padding predeterminado de las celdas */
        }
        .logo-cell {
            text-align: right; /* Alinea el contenido (logo) a la derecha de esta celda */
            width: 30%; /* Ajusta el ancho según necesites para el logo */
        }
        .logo-img {
            width: 150px; /* Ancho máximo para el logo */
            height: 85px; /* Altura fija para el logo */
            display: block; /* Elimina espacio extra debajo de la imagen */
            margin-left: auto; /* Centra la imagen si la celda es más ancha que el max-width */
            margin-right: 0; /* Asegura que se alinee a la derecha */
        }
        .left-header-content {
            text-align: left; /* Alinea el contenido a la izquierda */
            width: 70%; /* El resto del ancho para el contenido izquierdo */
            padding-right: 10px; /* Espacio entre el texto y el logo */
        }

        .signature-img {
            max-width: 100px; /* Ancho máximo para la imagen de la firma */
            max-height: 50px; /* Altura máxima para la imagen de la firma */
            height: auto; /* Mantiene la proporción de la imagen */
            object-fit: contain; /* Asegura que la imagen se ajuste sin recortarse */
            display: block; /* Asegura que se comporte como un bloque para el espaciado */
            /* No negative margins here */
        },
        .signature-box {
            /* Fuente profesional y legible */
            font-family: 'Roboto', sans-serif;
            font-size: 9pt;
            line-height: 1.6;
            text-align: justify; /* Justificar texto para mejor legibilidad */
            margin-bottom: 0.5em; /* Espacio reducido entre párrafos */
            margin-top: 0.5em; /* Espacio reducido entre párrafos */
            /* Diseño del contenedor */
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: rgb(247, 247, 247)
            
           
        }

        .signature-box p {
            margin: 0;
            text-align: justify;
        }

        /* Estilo para resaltar conceptos clave */
        .highlight {
            font-weight: 600;
            color: #000;
        }

        /* Espacio para la firma real si es necesario */
        .signature-space {
            margin-top: 60px;       /* Un poco más de espacio para que no choque con el texto */
            border-top: 1px solid #000;
            width: 250px;
            
            /* ESTO ES LO QUE FALTA PARA CENTRAR EL BLOQUE */
            margin-left: auto;
            margin-right: auto;
            
            text-align: center;     /* Esto centra el texto DEBAJO de la línea */
            font-size: 9pt;
            color: #000;
            padding-top: 10px;      /* Espacio entre la línea y el texto "Firma..." */
            text-transform: uppercase; /* Opcional: le da un toque más formal */
            letter-spacing: 1px;    /* Opcional: mejora la legibilidad */
        }

        
    </style>
</head>
<body>
<table class="header-table">
    <tr>
        <td class="left-header-content">
            {{-- <p><strong>AM FUT PRO A.C.</strong></p>
            <p>Avenida Industria Automotriz No. 33 Interior 203,<br>
                Col. Corredor Industrial Toluca-Lerma,<br>
                C.P. 52004, Municipio de Lerma, Estado de México, México.</p> --}}
            </td>
        <td class="logo-cell">
            <img src="{{ public_path('style/logos/logo.png') }}" alt="logo" class="logo-img">
        </td>
    </tr>
</table>
<pre>
<p>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES QUE CELEBRAN POR UNA PARTE LA “AM FUT PRO” ASOCIACIÓN CIVIL REPRESENTADA EN ESTE ACTO POR SU REPRESENTANTE LEGAL ÁLVARO ORTIZ ARELLANO, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ “LA AMFpro”, Y POR OTRA PARTE, <b>{{ $nombre_usuario }}</b>, A QUIEN EN ADELANTE SE LE DENOMINARÁ COMO “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES, AL TENOR DE LAS DECLARACIONES Y CLÁUSULAS SIGUIENTES:</p>

<h2>D E C L A R A C I O N E S</h2>

<p><b>I. DECLARA “LA AMFpro” A TRAVÉS DE SU REPRESENTANTE LEGAL QUE:</b></p>
<p><b>I.1.-</b> ES UNA ASOCIACIÓN CIVIL, CON PERSONALIDAD JURÍDICA Y PATRIMONIO PROPIO, CONSTITUIDA CONFORME A LAS LEYES MEXICANAS, BAJO EL INSTRUMENTO NOTARIAL NÚMERO 119,932 DE FECHA 25 DE OCTUBRE DE 2017, ANTE LA FE DEL LICENCIADO JAVIER ISAÍAS PÉREZ ALMARAZ, NOTARIO PÚBLICO NO. 125 DE LA CIUDAD DE MÉXICO, DEBIDAMENTE INSCRITA EN EL REGISTRO PÚBLICO DE LA PROPIEDAD Y DEL COMERCIO.</p>
<p><b>I.2.-</b> TIENE DENTRO DE SU OBJETO SOCIAL, ENTRE OTROS, EL REPRESENTAR Y PROTEGER LOS INTERESES DE LAS Y LOS FUTBOLISTAS PROFESIONALES Y NO PROFESIONALES (AMATEURS), AFILIADOS A LA FEDERACIÓN MEXICANA DE FÚTBOL ASOCIACIÓN, ASOCIACIÓN CIVIL Y CELEBRAR TODA INDOLE DE CONTRATOS Y CONVENIOS PARA LA MEJOR REALIZACIÓN DE SU OBJETO.</p>
<p><b>I.3.-</b> EL SEÑOR ÁLVARO ORTIZ ARELLANO EN SU CARÁCTER DE REPRESENTANTE LEGAL DE “LA AMFpro”, CUENTA CON LAS FACULTADES LEGALES Y DE REPRESENTACIÓN REQUERIDAS PARA FIRMAR EL PRESENTE CONTRATO, LAS CUALES NO LE HAN SIDO REVOCADAS O MODIFICADAS A LA FECHA EN QUE SE SUSCRIBE EL PRESENTE INSTRUMENTO JURÍDICO.</p>
<p><b>I.4.-</b> ESTÁ INSCRITA EN EL REGISTRO FEDERAL DE CONTRIBUYENTES, BAJO EL NÚMERO AFP171026M79 Y QUE, PARA EFECTOS DEL PRESENTE CONTRATO, TIENE SU DOMICILIO EN AVENIDA INDUSTRIA AUTOMOTRIZ NO. 33 INTERIOR 203, COLONIA CORREDOR INDUSTRIAL TOLUCA-LERMA, C.P. 52004, MUNICIPIO DE LERMA, ESTADO DE MÉXICO, MÉXICO.</p>
<p><b>I.5.-</b> PARA EL CUMPLIMIENTO DE SU OBJETO SOCIAL TIENE LA NECESIDAD DE CONTRATAR PRESTADORES DE SERVICIOS PROFESIONALES, QUIENES DEBEN CONTAR CON LA CAPACIDAD SUFICIENTE PARA PROPORCIONAR LOS SERVICIOS PROFESIONALES QUE “LA AMFpro” REQUIERA.</p>

<p><b>II.- DECLARA “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” QUE:</b></p>
<p><b>II.1.-</b> ES DE NACIONALIDAD <b>{{ $nacionalidad }}</b>, SEXO <b>{{ $sexo }}</b>, <b>{{ $edad }}</b> AÑOS DE EDAD, ESTADO CIVIL <b>{{ $estado_civil }}</b>, <b>{{ $profesion }}</b> CON CÉDULA PROFESIONAL CON NÚMERO DE FOLIO <b>{{ $cedula_profesional }}</b>, RFC <b>{{ $RFC }}</b>, CURP <b>{{ $curp }}</b>, CON DOMICILIO EN: <b>{{ $domicilio }}</b>, C.P. <b>{{ $codigo_postal }}</b>, <b>{{ $entidad }}</b>.</p>
<p><b>II.2.-</b> ESTÁ EN PLENO USO DE SUS FACULTADES Y POSEE LA CAPACIDAD FÍSICA Y LEGAL PARA CONTRATARSE Y, ASIMISMO, CUENTA CON LAS APTITUDES NECESARIAS PARA DESEMPEÑAR LOS SERVICIOS PROFESIONALES REQUERIDOS POR “LA AMFpro”.</p>
<p><b>II.3.-</b> TIENE CONOCIMIENTO PLENO DEL OBJETO SOCIAL DE “LA AMFpro” Y CUENTA CON LA EXPERIENCIA NECESARIA PARA EJECUTAR LAS ACTIVIDADES PARA LAS CUALES ES CONTRATADA.</p>
<p><b>II.4.-</b> LOS HONORARIOS QUE PERCIBIRÁ DE “LA AMFpro” NO SON NI REPRESENTAN SU ÚNICA FUENTE DE INGRESO, TODA VEZ QUE, DURANTE LA VIGENCIA DEL PRESENTE CONTRATO, PRESTA (O PRESTARÁ) SUS SERVICIOS PROFESIONALES A DIFERENTES PERSONAS FÍSICAS Y/O MORALES DE QUIENES, EN SU CASO, RECIBE (O RECIBIRÁ) TAMBIÉN HONORARIOS QUE PODRÁN SER, EN SU CASO, SUPERIORES AL MONTO PACTADO MENSUALMENTE, POR LO QUE NO SE CONSIDERARÁ EN NINGÚN CASO TRABAJADOR DE “LA AMFpro”.</p>

<p><b>III.- DECLARAN “LAS PARTES” QUE:</b></p>
<p><b>III.1.-</b> PARA EL OTORGAMIENTO Y SUSCRIPCIÓN DEL PRESENTE CONTRATO NO EXISTE DOLO, ERROR, MALA FE O CUALQUIER OTRO VICIO DE LA VOLUNTAD QUE PUDIERE INVALIDARLO, POR LO QUE EXPRESAMENTE RENUNCIAN A INVOCARLOS EN CUALQUIER TIEMPO.</p>
<p><b>III.2.-</b> ES SU VOLUNTAD CELEBRAR EL PRESENTE CONTRATO Y SE SUJETAN A LAS SIGUIENTES:</p>

<h2>C L Á U S U L A S</h2>

<p><b>PRIMERA.- PRESTACIÓN DE SERVICIOS PROFESIONALES.</b> “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” SE OBLIGA A PROPORCIONAR A LA “LA AMFpro”, LOS SERVICIOS PROFESIONALES QUE SE MENCIONAN EN LA CLÁUSULA SEGUNDA DE ESTE CONTRATO, SIN QUE ESTO IMPLIQUE SUBORDINACIÓN, RELACIÓN O VÍNCULO LABORAL ALGUNO, DEBIDO A QUE LA NATURALEZA DEL PRESENTE INSTRUMENTO ES ESTRICTAMENTE CIVIL.</p>

<p><b>SEGUNDA.- SERVICIOS PROFESIONALES.</b> “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” SE OBLIGA A PROPORCIONAR DURANTE LA VIGENCIA DE ESTE CONTRATO, LOS SERVICIOS PROFESIONALES QUE LE SOLICITE “LA AMFpro”, LOS CUALES DE MANERA ENUNCIATIVA Y NO LIMITATIVA CONSISTEN EN:</p>
<p><b>A.-</b> APOYAR A “LA AMFpro” COMO <b>{{ $puesto }}</b>, COADYUVANDO CON EL DESARROLLO DE SU OBJETO SOCIAL, PRESTANDO LOS SERVICIOS PROFESIONALES SIGUIENTES:</p>
<p><b>{!! $actividades_realizar !!}</b></p>

<p><b>B.-</b> AQUELLAS OTRAS QUE LE SEAN ENCOMENDADAS Y SOLICITADAS POR “LA AMFpro”, POR CONDUCTO DE SU PRESIDENCIA Y/O SECRETARÍA GENERAL PARA EL CUMPLIMIENTO DE SU OBJETO SOCIAL Y QUE SE RELACIONEN CON SUS CONOCIMIENTOS Y EXPERIENCIA.</p>

<p><b>TERCERA.- VIGENCIA.</b> “LAS PARTES” ACEPTAN QUE LA VIGENCIA DEL PRESENTE CONTRATO ES A PARTIR DEL DÍA <b>{{ $fecha_inicio }}</b> Y HASTA EL <b>{{ $fecha_fin }}</b>, FECHA EN LA CUAL FENECERÁ IRREMEDIABLEMENTE, SIN RESPONSABILIDAD PARA “LAS PARTES”.</p>

<p><b>CUARTA.- HONORARIOS.</b> “LAS PARTES” CONVIENEN QUE LOS HONORARIOS MENSUALES QUE PERCIBIRÁ “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” SERÁ LA CANTIDAD DE <b>{{ $salario_numero }} ({{ $salario_texto }} M.N.)</b> NETOS.</p>

<p><b>QUINTA.- FORMA DE PAGO.</b> “LAS PARTES” PACTAN QUE EL PAGO DE LOS HONORARIOS QUE DERIVAN DE LA PRESTACIÓN DE SERVICIOS SERÁ REALIZADO A TRAVÉS DE TRANSFERENCIA BANCARIA ELECTRÓNICA A LA CUENTA QUE “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” DESIGNE PARA TAL EFECTO.</p>
<p>DICHO PAGO SE HARÁ A MÁS TARDAR DENTRO DEL MES EN QUE HAYA ENTREGADO EL RECIBO DE HONORARIOS CORRESPONDIENTE DE ACUERDO CON LAS POLÍTICAS INSTITUCIONALES QUE RESULTEN APLICABLES, CUMPLIENDO CON LOS REQUISITOS FISCALES QUE EXIGE LA LEGISLACIÓN EN MATERIA, Y EL CUAL DEBERÁ SER PROPORCIONADO A MÁS TARDAR DENTRO DE LOS PRIMEROS CINCO DÍAS HÁBILES DE CADA MES.</p>

<p><b>SEXTA.- GASTOS Y VIÁTICOS.</b> “LAS PARTES” CONVIENEN QUE EN CASO DE QUE “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” REQUIERA DEL PAGO DE VIÁTICOS PARA TRASLADO, INCLUYENDO DE MANERA ENUNCIATIVA Y NO LIMITATIVA HOSPEDAJE, ALIMENTACIÓN, BOLETOS DE AVIÓN Y/O CAMIÓN Y/O RENTA DE AUTOMÓVIL, DARÁ AVISO CON DEBIDA ANTICIPACIÓN A “LA AMFpro” PARA QUE ÉSTA REALICE LAS GESTIONES Y PAGOS NECESARIOS EN EL SUPUESTO DE RESULTAR PROCEDENTE, DEBIENDO CONSTAR LA PROCEDENCIA POR ESCRITO.</p>
<p>“LAS PARTES” CONVIENEN QUE “LA AMFpro” NO CUBRIRÁ NI REEMBOLSARÁ A “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” GASTO NI VIÁTICO ALGUNO QUE NO LE SEA PREVIAMENTE AUTORIZADO POR ESCRITO, Y/O CAREZCA DE COMPROBANTE FISCAL, QUE NO REÚNA TODOS LOS REQUISITOS QUE AL EFECTO IMPONEN LAS LEYES TRIBUTARIAS MEXICANAS, EL CUAL EN TODOS LOS CASOS DEBERÁ SER EXPEDIDO A FAVOR DE “LA AMFpro”.</p>

<p><b>SÉPTIMA.- CONFIDENCIALIDAD.</b> “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” SE OBLIGA A MANTENER ESTRICTA Y ABSOLUTA CONFIDENCIALIDAD RESPECTO DE LA INFORMACIÓN Y DOCUMENTACIÓN QUE POR LA NATURALEZA DE LA PRESTACIÓN DE SUS SERVICIOS PROFESIONALES DEBA CONOCER Y ADMINISTRAR, DURANTE Y EN UN PLAZO DE DIEZ AÑOS (10) POSTERIORES A LA VIGENCIA DE ESTE INSTRUMENTO, ABSTENIÉNDOSE EN TODO MOMENTO DE DIVULGAR, TRANSMITIR Y EMPLEAR DICHA INFORMACIÓN A SU FAVOR O DE TERCEROS, EN EL ENTENDIDO QUE DE NO ACATAR LO ESTIPULADO EN LA PRESENTE CLÁUSULA, TENDRÁ COMO CONSECUENCIA ADEMÁS DE LA RESCISIÓN DEL PRESENTE CONTRATO, SIN RESPONSABILIDAD PARA "LA AMFpro", LAS RESPONSABILIDADES DE CARÁCTER CIVIL, PENAL O CUALQUIER OTRA MATERIA QUE RESULTE PROCEDENTE, QUEDANDO FACULTADA "LA AMFpro" PARA EJERCITAR LAS ACCIONES LEGALES QUE ESTIME NECESARIAS.</p>

<p><b>OCTAVA.- DERECHOS DE PROPIEDAD INTELECTUAL.</b> “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” RECONOCE QUE NO ADQUIERE DERECHOS DE PROPIEDAD INTELECTUAL SOBRE MARCAS, DERECHOS DE AUTOR, ASÍ COMO LICENCIAS, PERMISOS Y AUTORIZACIONES DE USO, DE LAS CUALES “LA AMFpro” SEA TITULAR.</p>

<p><b>NOVENA.- SITUACIÓN CONTRACTUAL.</b> “LAS PARTES” RECONOCEN Y ACEPTAN EXPRESAMENTE QUE EL PRESENTE CONTRATO DE PRESTACIÓN DE SERVICIOS POR HONORARIOS NO REPRESENTA POR NINGÚN MOTIVO RELACIÓN DE SUBORDINACIÓN O VÍNCULO LABORAL ALGUNO, TODA VEZ QUE “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” RECONOCE QUE ÚNICA Y EXCLUSIVAMENTE APLICA SUS CONOCIMIENTOS DENTRO DE SUS CAPACIDADES, BASADOS EN PLANES DE TRABAJO CON RESULTADOS QUE LA PROPIA “PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” PLANIFICA Y EJECUTA, DOTÁNDOLA ASÍ DE PLENA AUTONOMÍA E INDEPENDENCIA CON RELACIÓN A “LA AMFpro”, AUNADO A QUE LOS SERVICIOS PRESTADOS SON REQUERIDOS OCASIONALMENTE POR “LA AMFpro” Y NO SON DE MANERA PERMANENTE.</p>

<p><b>DÉCIMA.- TERMINACIÓN ANTICIPADA DEL CONTRATO.</b> “LAS PARTES” CONVIENEN EXPRESAMENTE QUE “LA AMFpro” PODRÁ DAR POR TERMINADO ANTICIPADAMENTE Y EN CUALQUIER MOMENTO EL PRESENTE CONTRATO;</p>
<p>LO ANTERIOR, SIN RESPONSABILIDAD ALGUNA PARA “LA AMFpro”, SIN NECESIDAD DE RESOLUCIÓN JUDICIAL Y SIN PAGO EXTRAORDINARIO ALGUNO, BASTANDO UN AVISO QUE “LA AMFpro”, POR MEDIO DEL PERSONAL QUE ÉSTA DESIGNE Y QUE REALICE A “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” CON 15 DÍAS NATURALES DE ANTICIPACIÓN.</p>
<p>SI “LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES” NO PUEDE CONTINUAR PRESTADO SUS SERVICIOS DEBERÁ AVISAR OPORTUNAMENTE A “LA AMFpro”, QUIEN ESTARÁ FACULTADA PARA INTERPONER LAS ACCIONES TENDIENTES A RECLAMAR LOS DAÑOS Y PERJUICIOS QUE DERIVEN CUANDO NO SE DIERE ESTE AVISO CON OPORTUNIDAD.</p>

<p><b>DÉCIMA PRIMERA.- CUMPLIMIENTO DE OBLIGACIONES FISCALES.</b> “LAS PARTES” DEBERÁN CUMPLIR CON LAS OBLIGACIONES FISCALES QUE LE CORRESPONDA DE ACUERDO CON LA LEGISLACIÓN TRIBUTARIA APLICABLE, DEBIENDO ESTAR AL CORRIENTE EN DICHO CUMPLIMIENTO.</p>
<p>SI CUALQUIERA DE “LAS PARTES” NO ESTUVIERE AL CORRIENTE EN EL CUMPLIMIENTO DE SUS OBLIGACIONES FISCALES, LA PARTE QUE SI LO ESTUVIERE PODRÁ DAR POR TERMINADO, SIN RESPONSABILIDAD ALGUNA, EL PRESENTE CONTRATO, UNA VEZ CONOCIDO DICHO INCUMPLIMIENTO.</p>

<p><b>DÉCIMA SEGUNDA.- CESIÓN DE DERECHOS.</b> LOS DERECHOS Y OBLIGACIONES DERIVADOS DE ESTE CONTRATO, NO PODRÁN SER CEDIDOS NI TRANSFERIDOS EN MODO ALGUNO, SIN LA AUTORIZACIÓN PREVIA Y POR ESCRITA DE AMBAS PARTES.</p>

<p><b>DÉCIMA TERCERA.- DOMICILIO.</b> “LAS PARTES” SEÑALAN COMO DOMICILIOS PARA OÍR Y RECIBIR NOTIFICACIONES LOS SIGUIENTES:</p>

<p><b>“LA AMFpro”:</b> AVENIDA INDUSTRIA AUTOMOTRIZ, NO. 33 INTERIOR 203, COL. CORREDOR INDUSTRIAL TOLUCA-LERMA, C.P. 52004, MUNICIPIO DE LERMA, ESTADO DE MÉXICO, MÉXICO.</p>
<p><b>“LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES”:</b> <b>{{ $domicilio }}</b>, C.P. <b>{{ $codigo_postal }}</b>, <b>{{ $entidad }}</b>.</p>


<p><b>DÉCIMA CUARTA.- TÍTULOS DE LAS CLÁUSULAS.</b> “LAS PARTES” CONVIENEN EN QUE LOS TÍTULOS QUE APARECEN EN CADA UNA DE LAS CLÁUSULAS DE ESTE CONTRATO, SON EXCLUSIVAMENTE PARA FACILITAR SU LECTURA Y, POR CONSIGUIENTE, NO SE CONSIDERARÁ QUE DEFINEN, LIMITAN O DESCRIBEN EL CONTENIDO DE LAS CLÁUSULAS DEL MISMO, NI PARA EFECTOS DE SU INTERPRETACIÓN O CUMPLIMIENTO.</p>

<p><b>DÉCIMA QUINTA.- LEGISLACIÓN APLICABLE.</b> ESTE CONTRATO Y LOS DERECHOS Y OBLIGACIONES DE “LAS PARTES” QUE EN EL INTERVIENEN, SE INTERPRETARÁN DE ACUERDO CON LAS NORMAS CONTENIDAS EN EL CÓDIGO CIVIL DEL ESTADO DE MÉXICO VIGENTE, ASÍ COMO DE ACUERDO CON LOS CRITERIOS JURISPRUDENCIALES Y JURISPRUDENCIAS QUE DE ÉL EMANEN.</p>

<p><b>DÉCIMA SEXTA.- SOLUCIÓN DE CONTROVERSIAS.</b> ANTE CUALQUIER CLASE DE CONTROVERSIA DERIVADA DE O RELACIONADA CON EL PRESENTE CONTRATO, SUS ANEXOS SI ESTOS EXISTIEREN O, EN SU CASO, CON SUS RESPECTIVAS MODIFICACIONES, LAS PARTES SE COMPROMETEN A NEGOCIARLA DE BUENA FE Y, EN SU DEFECTO A SOMETERLA, A ELECCIÓN DE “LAS PARTES”, A LA MEDIACIÓN DE UN MEDIADOR CONCILIADOR PRIVADO CERTIFICADO Y AUTORIZADO POR EL PODER JUDICIAL DEL ESTADO DE MÉXICO, O A LA MEDIACIÓN DE UN MEDIADOR CONCILIADOR PÚBLICO DEL CENTRO ESTATAL DE MEDIACIÓN, CONCILIACIÓN Y DE JUSTICIA RESTAURATIVA DEL PODER JUDICIAL DEL ESTADO DE MÉXICO DE ACUERDO CON LA LEGISLACIÓN, REGLAMENTACIÓN Y DISPOSICIONES APLICABLES EN EL ESTADO DE MÉXICO.</p>
<p>DE NO PODERSE SOLUCIONAR LA CONTROVERSIA MEDIANTE DICHOS MEDIOS ALTERNATIVOS DE SOLUCIÓN DE CONFLICTOS, “LAS PARTES” SEÑALAN A LOS TRIBUNALES DE TOLUCA DE LERDO, ESTADO DE MÉXICO COMO LOS ÚNICOS COMPETENTES PARA CONOCER Y FALLAR EN TODAS SUS INSTANCIAS DE LAS CUESTIONES QUE SE SUSCITEN CON MOTIVO DE LA INTERPRETACIÓN Y CUMPLIMIENTO DEL PRESENTE CONTRATO, RENUNCIANDO EXPRESAMENTE A CUALQUIER OTRO QUE PUDIERA CORRESPONDERLES POR VIRTUD DE SUS DOMICILIOS PRESENTES O FUTUROS O POR CUALQUIER OTRA RAZÓN CAUSA GENERADORA DE COMPETENCIA TERRITORIAL.</p>

<p>LEÍDO QUE FUE EL PRESENTE CONTRATO Y ENTERADAS LAS PARTES DE SU CONTENIDO, VALOR Y ALCANCE LEGAL, LO FIRMAN DE CONFORMIDAD POR DUPLICADO, EN LERMA, ESTADO DE MÉXICO, EL DÍA <b>{{ $fecha_firma_contrato_texto }}</b>.</p>

<div class="firma-area">
    <div class="signature-block">
        “LA AMFpro”<br><br>
        <img src="{{ $firma_alvaro }}" alt="Firma de la persona trabajadora" class="signature-img">
        <div class="firma-line"></div>
        ÁLVARO ORTIZ ARELLANO<br>
        REPRESENTANTE LEGAL
    </div>
    <div class="signature-block">
        "LA PERSONA PRESTADORA DE SERVICIOS PROFESIONALES”<br><br>
         @if (!empty($firma))
            <img src="{{ public_path('ArchivosSistema/FirmasContratos/' . $firma) }}" alt="Firma de la persona trabajadora" class="signature-img">
        @else
        <br>
        <br>
        @endif
        <div class="firma-line"></div>
        {{ $nombre_usuario }}<br>
        {{-- {{ $profesion }} --}}
    </div>
</div>
    @if (!empty($firma))
    <div class="signature-box">
        <p>
        DE MANERA VOLUNTARIA MANIFIESTO ESTAR DE ACUERDO Y SUJETARME A LOS TÉRMINOS Y CONDICIONES DEL PRESENTE CONTRATO. ASIMISMO, RECONOZCO QUE LA FIRMA DIGITAL INSERTA EN EL DOCUMENTO CORRESPONDE A MI FIRMA AUTÓGRAFA, LA CUAL COINCIDE EN TODOS SUS TRAZOS Y FORMAS CON LA QUE APARECE EN LA IDENTIFICACIÓN OFICIAL QUE SE ADJUNTA AL PRESENTE Y QUE SE PLASMA EN ESTE ACTO A FIN DE CONVALIDAR LO ANTERIOR, PARA LOS EFECTOS LEGALES Y ADMINISTRATIVOS A LOS QUE HAYA LUGAR.
        </p>
        <br>
        <div class="signature-space">
            NOMBRE Y FIRMA
        </div>
    </div>
    @endif
</pre>
</body>
</html>