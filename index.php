<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Simple markers</title>
        <style>
        </style>
    </head>
    <body>

        <h1>CARTELERA</h1>
        <form action="cines.php" method="POST">
            <p>Selecciona una película: 
                <select name="filmName" >
                    <?PHP
                    require_once('wsdl/lib/nusoap.php');
                    require_once('tools/cleanString.php');

                    $cliente = new nusoap_client('http://localhost/proyectos/mashup/wsdl/servicio.php');

                    $estrenos = $cliente->call('getCartelera', array());
                    

                    foreach ($estrenos as $pelicula){
                        echo "<option value='$pelicula'>";
                        echo string2url($pelicula);
                        echo "</option>";
                    }
                    
                    
                    ?>
                </select>                

            </p>
            
            <p>Selecciona una ciudad: 
                <select name="cityId" >
                    <option value ="72413">
                        Alicante
                    </option>
                    <option value ="72480">
                        Barcelona
                    </option>
                    <option value ="72170">
                        Bilbao
                    </option>
                    <option value ="72234">
                        Córdoba
                    </option>
                    <option value ="72640">
                        Gijón
                    </option>
                    <option value ="72166">
                        Las Palmas de Gran Canaria
                    </option>
                    <option value ="72368">
                        Madrid
                    </option>
                    <option value ="72703">
                        Málaga
                    </option>
                    <option value ="72335">
                        Murcia
                    </option>
                    <option value ="72684">
                        Palma de Mallorca
                    </option>
                    <option value ="72572">
                        Sevilla
                    </option>
                    <option value ="72141">
                        Valencia
                    </option>
                    <option value ="72540">
                        Valladolid
                    </option>
                    <option value ="72797">
                        Vigo
                    </option>
                    <option value ="72466">
                        Zaragoza
                    </option>
                </select>                

            </p>

            <input type="submit" value="buscar cines"/>
            
        </form>

    </body>
</html>



