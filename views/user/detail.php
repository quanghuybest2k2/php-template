<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Chi tiết người dùng</h1>

        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Tên:</span>
                <span class="text-gray-900"><?php echo htmlspecialchars($user->name); ?></span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Email:</span>
                <span class="text-gray-900"><?php echo htmlspecialchars($user->email); ?></span>
            </div>

            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Ngày tạo:</span>
                <span class="text-gray-900"><?php echo (new DateTime($user->created_at))->format('d/m/Y H:i:s'); ?></span>
            </div>
        </div>

        <div class="mt-6">
            <a href="/users" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                ← Quay lại danh sách
            </a>
        </div>
    </div>
</div>