<div class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tạo mới người dùng</h1>

        <form method="POST" action="/store" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="name">Tên</label>
                <input type="text" id="name" name="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                <input type="text" id="email" name="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="password">Mật khẩu</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    Tạo mới
                </button>

                <a href="/users"
                    class="text-gray-600 hover:text-blue-600 transition text-sm">
                    ← Quay lại danh sách
                </a>
            </div>
        </form>
    </div>
</div>