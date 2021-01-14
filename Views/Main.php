<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<?php
		require_once __DIR__ . "/Templates/head.phtml";
	?>
</head>
<body class="d-flex flex-column h-100">
<?php
	require_once __DIR__ . "/Templates/header.phtml";
	
	if (isset($view))
	{
		require_once $view->body;
	}
	
	require_once __DIR__ . "/Templates/footer.phtml";
?>
</body>
</html>
