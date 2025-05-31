<?php include 'app/views/shares/header.php'; ?>
<h1>Danh sách danh mục</h1>
<a href="/webbanhang/Category/add" class="btn btn-success mb-2">Thêm danh mục mới</a>
<ul class="list-group">
    <?php foreach ($categories as $category): ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <!-Sử dụng grid để hiển thị nhiều cột -->
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="/webbanhang/Category/show/<?php echo $category->id; ?>">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <p class="card-text flex-grow-1">
                            <?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div class="mt-auto">
                            <!- Đẩy nút xuống cuối card -->
                                <a href="/webbanhang/Category/edit/<?php echo $category->id; ?>"
                                    class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="/webbanhang/Category/delete/<?php echo $category->id; ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </a>
                        </div>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
</ul>
<?php include 'app/views/shares/footer.php'; ?>