<?php
function buildCustomUrl($page, $perPage)
{
    return "/users?page={$page}&perPage={$perPage}";
}
?>
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
                    <?php foreach ($data as $user): ?>
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
        <!-- Pagination -->
        <?php if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator && $data->lastPage() > 1): ?>
            <div class="mt-6 flex justify-center">
                <nav class="inline-flex shadow-sm" aria-label="Pagination">
                    <!-- Previous Button -->
                    <?php if ($data->onFirstPage()): ?>
                        <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-l border border-gray-300 cursor-not-allowed">
                            Trước
                        </span>
                    <?php else: ?>
                        <a href="<?php echo htmlspecialchars($data->previousPageUrl()); ?>"
                            class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-l hover:bg-gray-100 transition">
                            Trước
                        </a>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $data->lastPage(); $i++): ?>
                        <?php if ($i == $data->currentPage()): ?>
                            <span class="px-3 py-2 bg-blue-600 text-white border-t border-b border-blue-600">
                                <?php echo $i; ?>
                            </span>
                        <?php else: ?>
                            <a href="<?php echo htmlspecialchars(buildCustomUrl($i, $data->perPage())); ?>"
                                class="px-3 py-2 bg-white text-gray-700 border-t border-b border-gray-300 hover:bg-gray-100 transition">
                                <?php echo $i; ?>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <?php if ($data->hasMorePages()): ?>
                        <a href="<?php echo htmlspecialchars($data->nextPageUrl()); ?>"
                            class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-r hover:bg-gray-100 transition">
                            Tiếp
                        </a>
                    <?php else: ?>
                        <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-r border border-gray-300 cursor-not-allowed">
                            Tiếp
                        </span>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>
        <!-- End Pagination -->
    </div>
</div>