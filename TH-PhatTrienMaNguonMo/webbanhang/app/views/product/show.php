<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="/webbanhang/<?php echo $product->image ? htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8') : '/webbanhang/images/placeholder.png'; ?>" 
                 class="img-fluid rounded shadow-lg" 
                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="col-md-6">
            <h1 class="display-5 fw-bold"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h1>

            <p class="text-muted">
                Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <h2 class="my-3 text-danger fw-light">
                <?php echo number_format($product->price, 0, ',', '.'); ?> VND
            </h2>

            <div class="mt-4">
                <h4>Mô tả sản phẩm</h4>
                <p style="white-space: pre-wrap;"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="d-grid gap-2 my-4">
                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-lg">
                    Thêm vào giỏ hàng
                </a>
            </div>

            <div class="mt-4">
                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-secondary">Chỉnh sửa</a>
                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa</a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <a href="/webbanhang/Product/" class="btn btn-light">
                &larr; Quay lại danh sách sản phẩm
            </a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>