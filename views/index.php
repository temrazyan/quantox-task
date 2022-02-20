<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School</title>
</head>
<body>
<h1 style="text-align: center">Welcome!!!</h1>
<h2>Our School Lists</h2>
<?foreach ($schools as $school): ?>
    <h5 style="text-transform: uppercase"><?=$school->getName()?></h5>
    <p>School Students List:</p>

    <?php if (!isset($students[$school->getId()])): ?>
        <?php continue; ?>
    <?php endif;?>

    <ul>
        <?foreach ($students[$school->getId()] as $student):?>
            <li><a href="/student?id=<?= $student->getId(); ?>"><?= $student->getName() ?></a></li>
        <?endforeach;?>
    </ul>
<?endforeach;?>
</body>
</html>