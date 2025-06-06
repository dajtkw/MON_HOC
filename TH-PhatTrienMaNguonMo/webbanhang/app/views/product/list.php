<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Danh sách sản phẩm</h1>
    <a href="/webbanhang/Product/add" class="btn btn-success mb-3">Thêm sản phẩm mới</a>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                        <img src="/webbanhang/<?php echo $product->image ? htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8') : '/webbanhang/images/placeholder.png'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                        </h6>
                        <p class="card-text flex-grow-1">
                            <?php 
                                // Rút gọn mô tả nếu quá dài
                                $description = htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8');
                                if (strlen($description) > 100) {
                                    echo substr($description, 0, 100) . '...';
                                } else {
                                    echo $description;
                                }
                            ?>
                        </p>
                        <h5 class="text-danger font-weight-bold">
                            <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </h5>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary w-100 mb-2">Thêm vào giỏ hàng</a>
                        <div class="d-flex justify-content-between">
                             <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-warning">Sửa</a>
                             <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>