<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require 'TwitterApiExchange.php';

        function getTweetsPeliculas($nombrePelicula){
            return getTweets('?q='.$nombrePelicula.' since:2015-04-30&lang=es');
        }

        ?>
    </body>
</html>