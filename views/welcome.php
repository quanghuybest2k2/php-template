<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <title>Welcome to FlowPHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<body class="h-full flex items-center justify-center text-gray-800">
    <div class="text-center">
        <h1 class="text-5xl font-extrabold text-primary mb-4">
            <?= htmlspecialchars($greeting) ?>
        </h1>
        <p class="text-lg mb-8">
            You are running <span class="font-semibold">FlowPHP</span> – a minimal, elegant PHP framework.
        </p>
        <a href="https://github.com/quanghuybest2k2/flowphp" target="__blank" class="inline-block px-6 py-3 bg-primary text-white rounded-lg shadow-md hover:bg-black transition">
            Get Started on GitHub
        </a>
    </div>
</body>

</html>