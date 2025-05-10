<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Professeur - Digital Campus 221</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen">
    <!-- Container principal -->
    <div class="flex h-screen">
    <?php require_once ROOT_PATH . "/views/components/sidebarProf.php"; ?>
    <?= $content ?>
    </div>
</body>
</html>
    