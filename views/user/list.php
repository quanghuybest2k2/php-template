<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-6">

        <?php if (!empty($_SESSION['message'])): ?>
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                <?php
                echo htmlspecialchars($_SESSION['message']);
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Danh sách người dùng</h1>
            <a href="/create"
                class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition">
                + Tạo mới
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 text-left text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Tên</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border-b"><?php echo htmlspecialchars($user->id); ?></td>
                            <td class="px-4 py-3 border-b"><?php echo htmlspecialchars($user->name); ?></td>
                            <td class="px-4 py-3 border-b"><?php echo htmlspecialchars($user->email); ?></td>
                            <td class="px-4 py-3 border-b">
                                <a href="/users/<?php echo urlencode($user->id); ?>"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>