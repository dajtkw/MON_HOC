<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <!-- Sửa action của form ở đây -->
                        <form action="/webbanhang/account/checkUsernameExists" method="post">
                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-2 text-uppercase">Quên Mật Khẩu</h2>
                                <p class="text-white-50 mb-5">Vui lòng nhập tên người dùng của bạn!</p>

                                <?php if (isset($error) && !empty($error)) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="username" class="form-control form-control-lg" required />
                                    <label class="form-label" for="username">UserName</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Xác Nhận</button>

                            </div>
                            <div>
                                <p class="mb-0"><a href="/webbanhang/account/login" class="text-white-50 fw-bold">Quay lại Đăng nhập</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'app/views/shares/footer.php'; ?>
