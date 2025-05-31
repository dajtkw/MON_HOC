<?php include 'app/views/shares/header.php'; ?>
<h1>Thanh toán</h1>
<form method="POST" action="/webbanhang/Product/processCheckout">
    <div class="form-group">
        <label for="name">Họ tên:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group"></div>
    <label for="phone">Số điện thoại:</label>
    <input type="text" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="province">Tỉnh/Thành phố:</label>
        <select id="province" name="province" class="form-control" required>
            <option value="">Chọn Tỉnh/Thành phố</option>
        </select>
    </div>
    <div class="form-group">
        <label for="district">Quận/Huyện:</label>
        <select id="district" name="district" class="form-control" required>
            <option value="">Chọn Quận/Huyện</option>
        </select>
    </div>
    <div class="form-group">
        <label for="ward">Phường/Xã:</label>
        <select id="ward" name="ward" class="form-control" required>
            <option value="">Chọn Phường/Xã</option>
        </select>
    </div>
    <div class="form-group">
        <label for="street_address">Địa chỉ chi tiết (Số nhà, tên đường):</label>
        <input type="text" id="street_address" name="street_address" class="form-control" placeholder="Ví dụ: 123 Đường ABC" required>
    </div>

    <input type="hidden" id="full_address" name="full_address">
    
    <button type="submit" class="btn btn-primary">Thanh toán</button>
</form>
<a href="/webbanhang/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ
    hàng</a>
<?php include 'app/views/shares/footer.php'; ?>

<script>
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');
    const streetAddressInput = document.getElementById('street_address');
    const fullAddressInput = document.getElementById('full_address'); // Nếu bạn dùng input ẩn

    const apiBaseUrl = 'https://provinces.open-api.vn/api/';

    // Hàm gọi API
    async function fetchData(endpoint) {
        const response = await fetch(apiBaseUrl + endpoint);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json();
    }

    // Hàm cập nhật địa chỉ đầy đủ (nếu dùng input ẩn)
    function updateFullAddress() {
        const provinceText = provinceSelect.options[provinceSelect.selectedIndex]?.text || '';
        const districtText = districtSelect.options[districtSelect.selectedIndex]?.text || '';
        const wardText = wardSelect.options[wardSelect.selectedIndex]?.text || '';
        const streetText = streetAddressInput.value;

        if (provinceText && districtText && wardText && streetText) {
            fullAddressInput.value = `${streetText}, ${wardText}, ${districtText}, ${provinceText}`;
        } else {
            fullAddressInput.value = '';
        }
    }

    // Load tỉnh/thành phố
    async function loadProvinces() {
        try {
            const provinces = await fetchData('p/');
            provinceSelect.innerHTML = '<option value="">Chọn Tỉnh/Thành phố</option>'; // Reset
            provinces.forEach(province => {
                const option = new Option(province.name, province.code);
                provinceSelect.add(option);
            });
        } catch (error) {
            console.error('Không thể tải danh sách tỉnh/thành phố:', error);
        }
    }

    // Load quận/huyện khi tỉnh/thành phố thay đổi
    provinceSelect.addEventListener('change', async function() {
        const provinceCode = this.value;
        districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>'; // Reset
        wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>'; // Reset
        if (provinceCode) {
            try {
                const districtsData = await fetchData(`p/${provinceCode}?depth=2`);
                districtsData.districts.forEach(district => {
                    const option = new Option(district.name, district.code);
                    districtSelect.add(option);
                });
            } catch (error) {
                console.error('Không thể tải danh sách quận/huyện:', error);
            }
        }
        updateFullAddress(); // Cập nhật địa chỉ đầy đủ
    });

    // Load phường/xã khi quận/huyện thay đổi
    districtSelect.addEventListener('change', async function() {
        const districtCode = this.value;
        wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>'; // Reset
        if (districtCode) {
            try {
                const wardsData = await fetchData(`d/${districtCode}?depth=2`);
                wardsData.wards.forEach(ward => {
                    const option = new Option(ward.name, ward.code);
                    wardSelect.add(option);
                });
            } catch (error) {
                console.error('Không thể tải danh sách phường/xã:', error);
            }
        }
        updateFullAddress(); // Cập nhật địa chỉ đầy đủ
    });

    // Cập nhật địa chỉ đầy đủ khi các trường khác thay đổi
    wardSelect.addEventListener('change', updateFullAddress);
    streetAddressInput.addEventListener('input', updateFullAddress);


    // Tải danh sách tỉnh/thành phố khi trang được load
    document.addEventListener('DOMContentLoaded', loadProvinces);
</script>