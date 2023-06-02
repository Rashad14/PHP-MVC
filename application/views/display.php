<!DOCTYPE html>
<html>
<head>
    <title>Display Text</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Display Texts</h1>
        <div>
            <?php foreach ($texts as $text): ?>
                <p><?php echo $text['text']; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
