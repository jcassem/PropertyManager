<?php

require_once "propertyCard.php";

echo <<<END
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Property Manager</title>

    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">

</head>
<body>

END;


getPropertyCard(1);
getPropertyCard(2);

echo "</body></html>";