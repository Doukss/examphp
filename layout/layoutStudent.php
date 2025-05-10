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
<body class="dark:bg-slate-900 bg-gray-100 min-h-screen ">
      <!-- Container Principal -->
    <div class="flex h-screen">
    <?php require_once ROOT_PATH . "/views/components/studentSide.php"; ?>
         <!-- Contenu Principal -->
         <div class="flex-1 flex flex-col overflow-hidden">
         <?php require_once ROOT_PATH . "/views/components/headerStudent.php"; ?>
        <?= $content ?>
        </div>
    </div>

</body>
</html>