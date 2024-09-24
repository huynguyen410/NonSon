<form method="get" action="search.php">
    <div class="row">
        <div class="col-sm form-group mt-1">
            <label for="category">Phân Loại:</label>
            <select id="category" name="category" class="form-select mt-2">
                <option value="" <?php if(isset($_GET['category'])) echo ($category === '') ? 'selected' : ''; ?>>Tất cả</option>
                <option value="FF" <?php if(isset($_GET['category'])) echo ($category === 'FF') ? 'selected' : ''; ?>>Nón Full Face</option>
                <option value="12F" <?php if(isset($_GET['category'])) echo ($category === '12F') ? 'selected' : ''; ?>>Nón 1/2 Đầu</option>
                <option value="34F" <?php if(isset($_GET['category'])) echo ($category === '34F') ? 'selected' : ''; ?>>Nón 3/4 Đầu</option>
            </select>
        </div>
        <div class="col-sm form-group mt-1">
            <label for="price-range">Khoảng Giá:</label>
            <select id="price" name="price-range" class="form-select mt-2">
                <option value="" <?php if(isset($_GET['price-range'])) echo ($priceRange === '') ? 'selected' : ''; ?>>Tất cả</option>
                <option value="0-500000" <?php if(isset($_GET['price-range'])) echo ($priceRange === '0-500000') ? 'selected' : ''; ?>>Thấp hơn 500.000đ</option>
                <option value="500000-1000000" <?php if(isset($_GET['price-range'])) echo ($priceRange === '500000-1000000') ? 'selected' : ''; ?>>Từ 500.000đ đến 1.000.000đ</option>
                <option value="1000000" <?php if(isset($_GET['price-range'])) echo ($priceRange === '1000000') ? 'selected' : ''; ?>>Lớn hơn 1.000.000đ</option>
            </select>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Lọc sản phẩm</button>
        </div>
    </div>
</form>