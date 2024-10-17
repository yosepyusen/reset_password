<?php 

    define("HOST","sandbox.smtp.mailtrap.io");
    define("PORT","2525");
    define("USERNAME","b94ff59625e190");
    define("PASSWORD","478cb8f116f734");
    define("SMTP_SECURE","TLS");
    define("TIEMPO_VIDA",time()+60);//hace referencia de 1 minuto todo esta en segundos
    //time(): Devuelve el momento actual medido como el número de segundos desde la Época Unix (1 de Enero de 1970 00:00:00 GMT).

    //este archivo settings no se hace asi sino se crea un archivo .env (para variable de entorno y que la informacion es sensible)
?>