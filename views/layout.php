<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Example' ?></title>
    <!-- Favicon -->
    <link rel="icon" href="/public/favicon.png" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Optional: Tailwind config (for customization) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff5757',
                    },
                }
            }
        }
    </script>
</head>

<body>
    <?= $content ?>
</body>

</html>