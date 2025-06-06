<?php include 'app/views/shares/header.php'; ?>

<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h3 class="mb-0">Chỉnh sửa thông tin sản phẩm</h3>
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

        <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="description" name="description" class="form-control" rows="8" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <div class="input-group">
                            <input type="number" id="price" name="price" class="form-control"  value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
                            <div class="input-group-append">
                                <span class="input-group-text">VND</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Thay đổi hình ảnh</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                            <label class="custom-file-label" for="image">Chọn file mới...</label>
                        </div>
                        <div class="mt-3">
                            <img id="imagePreview" src="#" alt="Xem trước hình ảnh mới" class="img-thumbnail" style="display: none; max-width: 150px; max-height: 150px;"/>
                        </div>
                        <?php if ($product->image): ?>
                            <div class="mt-2" id="existingImageContainer">
                                <label>Hình ảnh hiện tại:</label><br>
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right bg-transparent border-top-0">
                <a href="/webbanhang/Product/" class="btn btn-secondary mr-2">Hủy bỏ</a>
                <button type="submit" class="btn btn-warning">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var preview = document.getElementById('imagePreview');
    var label = document.querySelector('.custom-file-label[for="image"]');
    var existingImageContainer = document.getElementById('existingImageContainer');

    if (file) {
        label.textContent = file.name;
        
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            
            if (existingImageContainer) {
                existingImageContainer.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>