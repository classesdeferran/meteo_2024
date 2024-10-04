<?php
error_reporting(0);

// año actual
$year = date("Y");

// ciudad por defecto
$ciudad = "Barcelona";

if($_GET) {
    $ciudad_form = $_GET['city'];
    $ciudad = urlencode($ciudad_form);
    $API_KEY = "57dd0d67b602215d88c9f993d422a09b";

    $URL = "https://api.openweathermap.org/data/2.5/weather?";
    $URL .= "q=$ciudad";
    $URL .= "&appid=$API_KEY";
    $URL .= "&units=metric";
    $URL .= "&lang=es";

    // echo $URL;

    $file = file_get_contents($URL);
    // echo $file;
    $json_meteo = json_decode($file, true);
    // print_r ($json_meteo);

    // var_dump($json_meteo['weather'][0]['icon']);
    $icono = $json_meteo['weather'][0]['icon'];
    $descripcion = $json_meteo['weather'][0]['description'];
    $temp_actual = round($json_meteo['main']['temp']);
    $temp_max = round($json_meteo['main']['temp_max']);
    $temp_min = round($json_meteo['main']['temp_min']);
    $humedad = $json_meteo['main']['humidity'];
    // echo "El icono es ".$icono;

    // $amanecer = date("H:i", $json_meteo['sys']['sunrise']);
    // $puesta = date("H:i", $json_meteo['sys']['sunset']);

    $amanecer = getdate($json_meteo['sys']['sunrise']);
    $puesta = getdate($json_meteo['sys']['sunset']);
    // print_r($amanecer);
    $amanecer=  ($amanecer['hours'].":".$amanecer['minutes']);
    $puesta = ($puesta['hours'].":".$puesta['minutes']);
    

    

   
    

} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Yo" />
    <meta name="description" content="Aplicación meterológica por ciudades" />
    <meta name="keywords" content="Meteo, Wheater, El tiempo" />
    <title>Meteo</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <header><h1>Meteo</h1></header>
    <main>
      <div>
        <form method="GET">
          <label for="city">Ciudad:</label>
          <div>
            <input type="text" id="city" name="city"  />
            <button type="submit">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-search"
                viewBox="0 0 16 16"
              >
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
                />
              </svg>
            </button>
          </div>
        </form>
      </div>

      <div class="salida_datos">
        <div class="textos">
          <p class="nombre_ciudad"><span><?php echo $ciudad_form ?></span></p>
          <div>
            <div>
              <p class="temp_actual"><span><?php echo $temp_actual ?>ºC</span></p>
            </div>
            <div>
              <p class="datos_sec">Mínima <span><?php echo $temp_min ?>ºC</span></p>
              <p class="datos_sec">Máxima <span><?php echo $temp_max ?>ºC</span></p>
              <p class="datos_sec">Humedad <span><?php echo $humedad ?>%</span></p>
            </div>
          </div>

          <div class="sol">
            <p class="amanecer">
              <img
                src="img/amanecer.svg"
                alt="Hora de salida del sol"
                class="icon_sol"
              />
              <span><?php echo $amanecer ?></span>
            </p>
            <p class="puesta">
              <img
                src="img/puesta.svg"
                alt="Hora de salida del sol"
                class="icon_sol"
              />
              <span><?php echo $puesta ?></span>
            </p>
          </div>
        </div>

        <div class="icono_ppal">
          <img src="img/<?php echo $icono; ?>.svg" alt="<?php echo $descripcion; ?>" />
        </div>
      </div>
    </main>
    <footer>
      <p>&copy Yo (<?php echo $year; ?>)</p>
       <p>Datos de Openweather</p>

    </footer>
  </body>
</html>
