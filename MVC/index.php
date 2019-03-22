<?php

require 'core/bootstrap.php';

require 'routes.php';

$uri = strtolower($_GET['uri'] ?? 'list');

if (isset($_GET['uri']) && strpos($_GET['uri'], '_')){
  require $router->parse($uri);
  return;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require $router->parse($_GET['uri']); ?>
</html>