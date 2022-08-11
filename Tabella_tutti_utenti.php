<?php

include "_settings.php";
updateInteractions();

include "_isAdmin.php";


$datas = array();
$tables = array('Utenti_prospetto', 'Demo_data', 'Illimitata_data', 'Visite_sito');

foreach ($tables as $table) {
    $datas[$table] = Query("SELECT * FROM $table");
}


$conn->close();
returndata(0, "Connection with MySQL database closed");
?>


<!DOCTYPE html>
<html lang="it">

<?php echo render('./template/site/head.php', array('title' => 'Tabella completa tutti gli utenti'), 1); ?>

<head>
    <style>
        @import url(<?php echo HOST_SITE ?>/template/site/_style_table.css);
    </style>
</head>

<body>
    <?php foreach ($datas as $nameTable => $data) : ?>
        <h2> <?php echo $nameTable ?></h2>
        <table>
            <thead>
                <tr>
                    <?php while ($fieldinfo = $data->fetch_field()) : ?>
                        <th> <?php echo $fieldinfo->name ?></th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $data->fetch_array(MYSQLI_ASSOC)) : ?>
                    <tr>
                        <?php foreach ($row as $cell) : ?>
                            <td> <?php echo htmlentities($cell) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</body>

</html>