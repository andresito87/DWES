<?php session_start(); ?>

<html>

<head>
    <title>Preferences Set</title>
</head>

<body>

    <?php
    $colors = array(
        'black' => "#000000",
        'white' => "#ffffff",
        'red' => "#ff0000",
        'blue' => "#0000ff"
    );

    $bg = $colors[$_POST['background']];
    $fg = $colors[$_POST['foreground']];

    $_SESSION['bg'] = $bg;
    $_SESSION['fg'] = $fg;
    ?>

    <p>Thank you. Your preferences have been changed to:<br />
        Background:
        <?php echo $_POST['background']; ?><br />
        Foreground:
        <?php echo $_POST['foreground']; ?>
    </p>

    <p>Click <a href="prefs_session_demo.php">here</a> to see the preferences
        in action.</p>

</body>

</html>