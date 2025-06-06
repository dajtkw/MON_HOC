<?php include 'app/views/shares/header.php'; ?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Thêm sản phẩm mới</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="description" name="description" class="form-control" rows="8" required></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <div class="input-group">
                            <input type="number" id="price" name="price" class="form-control"  required>
                            <div class="input-group-append">
                                <span class="input-group-text">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>">
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Hình ảnh sản phẩm</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">Chọn file...</label>
                        </div>
                        <div class="mt-3">
                            <img id="imagePreview" src="#" alt="Xem trước hình ảnh" class="img-thumbnail" style="display: none; max-width: 200px; max-height: 200px;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right bg-transparent border-top-0">
                <a href="/webbanhang/Product/" class="btn btn-secondary mr-2">Quay lại</a>
                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var preview = document.getElementById('imagePreview');
    var label = document.querySelector('.custom-file-label[for="image"]');

    if (file) {
        label.textContent = file.name;
        
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        label.textContent = 'Chọn file...';
        preview.src = '#';
        preview.style.display = 'none';
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>