<nav class="navbar fixed-top navbar-expand-md bg-primary">
    <a class="navbar-brand text-white" href="#">Sai Grocery Store</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#ad" aria-expanded="false">
        <span class="fa fa-bars text-white" aria-hidden="true"></span>
    </button>
    <div id="ad" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="admin.php"><i class="fa fa-home fa-x mr-1 "></i>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="edit_product.php"><i class="fa fa-edit fa-x mr-1"></i>Edit Product details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#m4" data-backdrop="static" data-toggle="modal"><i class="fa fa-plus-square fa-x mr-1"></i>Add Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white dropdown" id="admin" data-toggle="popover" data-placement="bottom" title="User profile"><i class="fa fa-user-circle fa-x mr-1"></i><?php echo $_SESSION["name"]; ?></a>
            </li>
        </ul>
    </div>
</nav>

<!-- add product modal -->

<div id="m4" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Product</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function_db.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="pname" class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="pname" class="form-control" value="" id="pname" placeholder="Product Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customFile" class="col-sm-4 col-form-label">Product Image</label>
                        <div class="custom-file col-sm-8">
                            <input type="file" name="file" class="custom-file-input form-control" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Images cannot be edited</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label pt-0" for="category">Category</label>
                        <div class="col-sm-8">
                            <select name="category" class="form-control" id="category" required>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Drinks">Drinks</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Oils">Oils</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label pt-0" for="quantity">Quantity</label>
                        <div class="col-sm-8">
                            <select name="qty" class="form-control" id="quantity" required>
                                <option value="1/2">1/2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label pt-0" for="unit">Units</label>
                        <div class="col-sm-8">
                            <select name="unit" class="form-control" id="unit" required>
                                <option value="kg">Kilogram</option>
                                <option value="L/Packets">Litre/Packets</option>
                                <option value="Bottle/Tin">Bottle/Tin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pprice" class="col-sm-4 col-form-label">Product Price</label>
                        <div class="col-sm-8">
                            <input type="text" name="pprice" class="form-control" value="" id="pprice" placeholder="Product Price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pavail" class="col-sm-4 col-form-label">Product Availability</label>
                        <div class="col-sm-8">
                            <input type="text" name="avail" class="form-control" value="" id="pavail" placeholder="availability in kg/L/bottle/tin" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" name="add" class="btn btn-success">Add Product</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>