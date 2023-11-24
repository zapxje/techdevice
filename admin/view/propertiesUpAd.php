<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Chỉnh sửa thuộc tính</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li><a href="index.php?act=categories">Thuộc tính sản phẩm</a></li>
                    <li class="active">Chỉnh sửa thuộc tính</li>
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
            <form action="index.php?act=properties&id=<?= $product['id'] ?>&status=4&idProperty=<?= $property['id'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên thuộc tính</label>
                        <input name="name" type="text" value="<?= $property['name'] ?>" class="form-control" required oninvalid="this.setCustomValidity('Nhập tên danh mục')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group has-success">
                        <label for="" class="control-label mb-1">Nội dung thuộc tính</label>
                        <textarea name="description" rows="5" placeholder="Mô tả danh mục" class="form-control"><?= $property['description'] ?></textarea>
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