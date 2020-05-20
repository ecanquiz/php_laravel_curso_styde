<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" 
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Listado de usuarios - Style.net</title>

    </head>
    <body>
        <h1><?= e($title); ?></h1>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?= e($user) ?></li>      
            <?php endforeach; ?>
        </ul>
    </body>
</html>
