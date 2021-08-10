<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
?>

<div class="site-about">
    <?php
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>ThumbnailLink</th>";
    echo "<th>DownloadLink</th>";
    echo "<th>ModifiedDate</th>";
    echo "<th>FileSize</th>";
    echo "<th>OwnerNames</th>";
    echo "</tr>";
    foreach ($files['items'] as $file) {
        echo "<tr><td>";
        print_r($file['title']);
        echo "</td><td> <img src='";
        if (isset($file['thumbnailLink'])) {
            print_r($file['thumbnailLink']);
        }
        echo "'/>";
        echo "</td><td> <a href='";
        print_r($file['embedLink']);
        echo "'>Download</a>";
        echo "</td><td>";
        print_r(date("d-m-Y", strtotime($file['modifiedDate'])));
        echo "</td><td>";
        if (isset($file['fileSize'])) {
            print_r(floor($file['fileSize'] * 0.001) . "MB");
        }
        echo "</td><td>";
        foreach ($file['ownerNames'] as $owner) {
            echo "<li>" . $owner . "</li>";
        }
        echo "</td></tr>";
    }
    echo "</table>";
    ?>
</div>