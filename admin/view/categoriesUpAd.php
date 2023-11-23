<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Chỉnh sửa danh mục</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li><a href="index.php?act=categories">Danh mục sản phẩm</a></li>
                    <li class="active">Chỉnh sửa danh mục</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Tiêu Đề -->

<!-- Nội Dung -->
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"></strong>
        </div>
        <div class="card-body">
            <form action="index.php?act=updateCategory&id=<?= $category['id'] ?>&update" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên danh mục</label>
                        <input name="name" type="text" value="<?= $category['name'] ?>" class="form-control" required oninvalid="this.setCustomValidity('Nhập tên danh mục')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Thứ tự danh mục</label>
                        <input id="inputField" name="ordinal_number" type="number" value="<?= $category['ordinal_number'] ?>" class="form-control">
                        <!-- onfocus="showSuggestions()" -->
                        <ul id="suggestionList" class="list-unstyled"></ul>
                    </div>
                    <div class="form-group has-success">
                        <label for="" class="control-label mb-1">Mô tả</label>
                        <textarea name="description" rows="5" placeholder="Mô tả danh mục" class="form-control"><?= $category['description'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="index.php?act=categories"><button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button></a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Nội Dung -->