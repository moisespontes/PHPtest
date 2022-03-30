<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | phptest</title>

        <!-- Favicons -->
        <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <link rel="icon" href="/assets/images/logo.png">
        <meta name="theme-color" content="#7952b3">

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            rel="stylesheet"   integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- include css app -->
        <?php if (isset($this->data['style'])) : ?>
            <?php foreach ($this->data['style'] as $style) :?> 
        <link rel="stylesheet" href="<?= url("/assets/css/{$style}.css"); ?>">
            <?php endforeach; ?>
        <?php endif;  ?> 
    </head>

    <body>
        <div class="container">