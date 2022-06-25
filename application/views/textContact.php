<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$method = $this->input->get('method');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRM Contact PY+</title>  

        <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-2.1.3.min.js'; ?>"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/pnotify/pnotify.custom.min.js"></script>
        <!-- estilos css -->
        <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.css'; ?>" type="text/css" rel="stylesheet" />        
        <link href="<?php echo base_url() . 'assets/css/main.css'; ?>" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url() . 'assets/pnotify/pnotify.custom.min.css'; ?>">
        <!-- estilos css -->


        <script type="text/javascript">
            var base_url = '<?php echo BASE_URL; ?>';
        </script>
    </head>
    <body> <?php
        if($method === '1') { ?>
        <div class="col-sm-12 well">
            <h3 style="text-decoration-color: #0064cd">addContact:</h3>

            <span>La API de “adContact” realiza la acción de insertar la cuenta o base al sistema Celiter para su posterior marcado, utilizando los siguientes parámetros por método POST (Todos los parámetros deben ser enviados, si no se tiene valor para ese parámetro va con valor vacio, los parámetros que deben tener si o si valor son el nroDoc,  nombre, apellido y por lo menos un teléfono telefono1):</span><br
            <br>
            <h5>Parámetros solicitados:</h5><br>
            <h3>url: <a href="http://services.skytel.com.py/api/Wsinsertcontact/addContact">http://services.skytel.com.py/api/Wsinsertcontact/addContact</a></h3><br>
            <p>
            <li>idCliente: este parámetro es proveido por Skytel una vez creada la campaña, es un string.</li>
            <li>idCampana: este parámetro es proveido por Skytel una vez creada la campaña, es un string.</li>
            <li>codeCliente: este es un código que utiliza el cliente por ejemplo Cordial, es un string.</li>
            <li>nroDoc: el Nro de documento es parámetro obligatorio, debe ir como string.</li>
            <li>apellido: apellido de la persona a contactar, string.</li>
            <li>nombre: nombre de la persona a contactar, string.</li>
            <li>estadoCivil: deber ir un texto, Ejemplo:  "Casado".</li>
            <li>sexo: una letra si es masculino "M", femenino "F" y empresa "E".</li>
            <li>fechaNac: La fecha de nacimiento debe ser en formato Y-m-d, Ejemplo: "2017-03-01".</li>
            <li>edad: un valor ejemplo 30.</li>
            <li>profesion: texto ejemplo "Abogado";</li>
            <li>segmento: en segmento debe venir desde que red social se esta contactando. Ejemplo "Facebook".</li>
            <li>shot: el shot es la partida de contactos en este caso N/A.</li>
            <li>tarjeta: Tipo de tarjeta. Ejemplo "VISA".</li>
            <li>nroTarjeta: el número de la tarjeta.</li>
            <li>vtoTarjeta: vencimiento de la tarjeta formato Y-m. Ejemplo "2017-03".</li>
            <li>calle: el nombre de las calles. Ejemplo "Calle A esq. Calle B".</li>
            <li>nroCasa: número de la casa.</li>
            <li>piso: piso es númerico Ejemplo "1".</li>
            <li>dpto: es un stgring ejemplo "1A".</li>
            <li>localidad: texto, nombre de la localidad.</li>
            <li>ciudad: texto, el nombre de la ciudad.</li>
            <li>barrio: texto, nombre del barrio.</li>
            <li>codPostal: 4 caracteres numéricos.</li>
            <li>provincia: texto, nombre de la provincia</li>
            <h6>Estos parámetros son numéricos, donde pueden ir el prefijo de la zona en prefijo o el número completo en teléfono. Ejemplo  en prefijoTel1 "11" y telefono1  "154654654" ó prefijoTel1 "" (vacio) y telefono1 "11154654654". De ambas formas funcionaría.</h6> 
            <li>prefijoTel1 = "";</li>
            <li>telefono1 = "0981119983";</li>
            <li>prefijoTel2 = "";</li>
            <li>telefono2 = "";</li>
            <li>prefijoTel3 = "";</li>
            <li>telefono3 = "";</li>
            <li>prefijoTel4 = "";</li>
            <li>telefono4 = "";</li>
            <li>prefijoTel5 = "";</li>
            <li>telefono5 = "";</li>
            <li>prefijoTel6 = "";</li>
            <li>telefono6 = "";</li>
            <li>correo1 = "";</li>
            <li>correo2 = "";</li>
            <li>obsCuenta: cualquier observación.</li>
            <li>Adicionales: son para campos adicionales que no figuran en este método pero que se puede necesitar para algún reporte. Debe ir un array de objetos con los títulos e info. Ejemplo [{"titulo":"pruaba1","info":"datos1"},{"titulo":"pruaba2","info":"datos2"}]; </li>

            <li><strong>Ejemplo de json a enviar en el campo datos: </strong></li> 
            <br>
            <p>
                {"idCliente":"27","idCampana":"41","codeCliente":"0","nroDoc":"123456","apellido":"Prueba de apellido","nombre":"prueba nombre","estadoCivil":"casado","sexo":"M","fechaNac":"2000-05-12","edad":"55","profesion":"ingeniero","segmento":"Alta","shot":"11","tarjeta":"visa","nroTarjeta":"555555555","vtoTarjeta":"2018-05-01","calle":"Calle de prueba","nroCasa":"4545","piso":"1","dpto":"a","localidad":"Capital","ciudad":"asuncion","barrio":"obrero","codPostal":"0000","provincia":"central","prefijoTel1":"","telefono1":"981119973","prefijoTel2":"","telefono2":"","prefijoTel3":"","telefono3":"","prefijoTel4":"","telefono4":"","prefijoTel5":"","telefono5":"","prefijoTel6":"","telefono6":"","correo1":"","correo2":"","obsCuenta":"","Adicionales":[{"titulo":"pruaba1","info":"datos1"},{"titulo":"pruaba2","info":"datos2"}]}
            </p>
            <br>
            <p>El objeto Adicionales contiene un array de objetos, donde van los campos adicionales que no se contemplan en celiter.</p>
            
            </p>
        </div <?php
        }
        elseif($method === '2') { ?>
        <div class="col-sm-12 well">
            <h3 style="text-decoration-color: #0064cd">addContactCola:</h3>

            <span>La API de “adContactCola” realiza la acción de insertar la cuenta y asigna a la cola o base al sistema Celiter para su posterior marcado, utilizando los siguientes parámetros por método POST (Todos los parámetros deben ser enviados, si no se tiene valor para ese parámetro va con valor vacio, los parámetros que deben tener si o si valor son el nroDoc,  nombre, apellido y por lo menos un teléfono telefono1):</span><br
                <br>
            <h5>Parámetros solicitados:</h5><br>
             <h3>url: <a href="http://services.skytel.com.py/api/Wsinsertcontact/addContactCola">http://services.skytel.com.py/api/Wsinsertcontact/addContactCola</a></h3><br>
            <p>
            <li>idCliente: este parámetro es proveido por Skytel una vez creada la campaña, es un string.</li>
            <li>idCampana: este parámetro es proveido por Skytel una vez creada la campaña, es un string.</li>
            <li>codeCliente: este es un código que utiliza el cliente por ejemplo Cordial, es un string.</li>
            <li>nroDoc: el Nro de documento es parámetro obligatorio, debe ir como string.</li>
            <li>apellido: apellido de la persona a contactar, string.</li>
            <li>nombre: nombre de la persona a contactar, string.</li>
            <li>estadoCivil: deber ir un texto, Ejemplo:  "Casado".</li>
            <li>sexo: una letra si es masculino "M", femenino "F" y empresa "E".</li>
            <li>fechaNac: La fecha de nacimiento debe ser en formato Y-m-d, Ejemplo: "2017-03-01".</li>
            <li>edad: un valor ejemplo 30.</li>
            <li>profesion: texto ejemplo "Abogado";</li>
            <li>segmento: en segmento debe venir desde que red social se esta contactando. Ejemplo "Facebook".</li>
            <li>shot: el shot es la partida de contactos en este caso N/A.</li>
            <li>tarjeta: Tipo de tarjeta. Ejemplo "VISA".</li>
            <li>nroTarjeta: el número de la tarjeta.</li>
            <li>vtoTarjeta: vencimiento de la tarjeta formato Y-m. Ejemplo "2017-03".</li>
            <li>calle: el nombre de las calles. Ejemplo "Calle A esq. Calle B".</li>
            <li>nroCasa: número de la casa.</li>
            <li>piso: piso es númerico Ejemplo "1".</li>
            <li>dpto: es un stgring ejemplo "1A".</li>
            <li>localidad: texto, nombre de la localidad.</li>
            <li>ciudad: texto, el nombre de la ciudad.</li>
            <li>barrio: texto, nombre del barrio.</li>
            <li>codPostal: 4 caracteres numéricos.</li>
            <li>provincia: texto, nombre de la provincia</li>
            <h6>Estos parámetros son numéricos, donde pueden ir el prefijo de la zona en prefijo o el número completo en teléfono. Ejemplo  en prefijoTel1 "11" y telefono1  "154654654" ó prefijoTel1 "" (vacio) y telefono1 "11154654654". De ambas formas funcionaría.</h6> 
            <li>prefijoTel1 = "";</li>
            <li>telefono1 = "0981119983";</li>
            <li>prefijoTel2 = "";</li>
            <li>telefono2 = "";</li>
            <li>prefijoTel3 = "";</li>
            <li>telefono3 = "";</li>
            <li>prefijoTel4 = "";</li>
            <li>telefono4 = "";</li>
            <li>prefijoTel5 = "";</li>
            <li>telefono5 = "";</li>
            <li>prefijoTel6 = "";</li>
            <li>telefono6 = "";</li>
            <li>correo1 = "";</li>
            <li>correo2 = "";</li>
            <li>obsCuenta: cualquier observación.</li>
            <li>Adicionales: son para campos adicionales que no figuran en este método pero que se puede necesitar para algún reporte. Debe ir un array de objetos con los títulos e info. Ejemplo [{"titulo":"pruaba1","info":"datos1"},{"titulo":"pruaba2","info":"datos2"}]; </li>

            <li><strong>Ejemplo de json a enviar en el campo datos: </strong></li> 
            <br>
            <p>
                {"idCliente":"27","idCampana":"41","codeCliente":"0","nroDoc":"123456","apellido":"Prueba de apellido","nombre":"prueba nombre","estadoCivil":"casado","sexo":"M","fechaNac":"2000-05-12","edad":"55","profesion":"ingeniero","segmento":"Alta","shot":"11","tarjeta":"visa","nroTarjeta":"555555555","vtoTarjeta":"2018-05-01","calle":"Calle de prueba","nroCasa":"4545","piso":"1","dpto":"a","localidad":"Capital","ciudad":"asuncion","barrio":"obrero","codPostal":"0000","provincia":"central","prefijoTel1":"","telefono1":"981119973","prefijoTel2":"","telefono2":"","prefijoTel3":"","telefono3":"","prefijoTel4":"","telefono4":"","prefijoTel5":"","telefono5":"","prefijoTel6":"","telefono6":"","correo1":"","correo2":"","obsCuenta":"","Adicionales":[{"titulo":"pruaba1","info":"datos1"},{"titulo":"pruaba2","info":"datos2"}]}</p>
            <br>
            <p>El objeto Adicionales contiene un array de objetos, donde van los campos adicionales que no se contemplan en celiter.</p>
            
            </p>
        </div> <?php
        }
        elseif($method === '3') { ?>
        <div class="col-sm-12 well">
            <h3 style="text-decoration-color: #0064cd">GetGestionInfo:</h3>

            <span>La API de “getGestionInfo” realiza la acción de devolver los datos de la cuenta, el id de la llamada y los datos de la venta, utilizando como parámetros por método POST (El parámetro debe ser enviado, caso contrario se devuelve error):</span><br
                <br>
            <h5>Parámetros solicitados:</h5><br>
             <h3>url: <a href="http://services.skytel.com.py/api/Wsinsertcontact/getGestionInfo">http://services.skytel.com.py/api/Wsinsertcontact/getGestionInfo</a></h3><br>
<!--             <h3>url: <a href="http://salientes.localhost/api/Wsinsertcontact/getGestionInfo">http://services.skytel.com.py/api/Wsinsertcontact/getGestionInfo</a></h3><br>-->
            <p>
            <li>idGestion: este parámetro es proveido por Skytel una vez realizada la Gestión de la cuenta, es un string.</li>

            <li><strong>Ejemplo de json a enviar en el campo datos: </strong></li> 
            <br>
            <p>{"idGestion":"5289619"}</p>
            <br>
            </p>
        </div> <?php
        } ?>
</body>
</html>