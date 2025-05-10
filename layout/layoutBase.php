<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Executive - École 221</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
</head>
<body class="bg-gray-200 text-gray-100">
    <div class="min-h-screen flex">
         <?php require_once ROOT_PATH . "/views/components/sidebar.php"; ?>
          <!-- Contenu Principal -->
        <main class="flex-1 ml-72 p-8 space-y-8">
            <?= $content ?>
        </main>
    </div>
</body>
</html>