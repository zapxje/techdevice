<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Chỉnh sửa thương hiệu</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li><a href="index.php?act=brands">Thương hiệu sản phẩm</a></li>
                    <li class="active">Chỉnh sửa thương hiệu</li>
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
            <form action="index.php?act=updateBrand&id=<?= $brand['id'] ?>&update" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên thương hiệu</label>
                        <input name="name" type="text" value="<?= $brand['name'] ?>" class="form-control" required oninvalid="this.setCustomValidity('Nhập tên thương hiệu')" oninput="setCustomValidity('')">
                    </div>
                </div>
                <div class="form-group brand-image">
                    <img src="../view/assets/img/brand_image/<?= $brand['image'] ?>" alt="">
                </div>
                <label for="" class="control-label mb-1">Logo thương hiệu</label>
                <input type="text" hidden name="old_image" value="<?= $brand['image'] ?>" class="form-control-file">
                <input type="file" id="file-input" name="new_image" class="form-control-file">
        </div>
        <div class="modal-footer">
            <a href="index.php?act=brands"><button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button></a>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
        </form>
    </div>
</div>
</div>
<!-- Nội Dung -->