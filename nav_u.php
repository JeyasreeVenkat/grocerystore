<nav class="navbar fixed-top navbar-expand-lg bg-primary">

    <a class="navbar-brand text-white" href="user_home.php">Grocery Store</a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav_u" aria-expanded="false">
        <span class="fa fa-bars text-white" aria-hidden="true"></span>
    </button>


    <div id="nav_u" class="collapse navbar-collapse">
        <form id="form" class="form-inline">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search" required>
                <div class="input-group-append">
                    <button class="btn" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link text-white" href="user_home.php"><i class="fa fa-home fa-x mr-1"></i>Home</a>
            </li>
            <li id="drop" class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">Items</a>
                <div class="dropdown-menu">
                    <a href="user_home.php#Vegetables" class="dropdown-item">Vegetables</a>
                    <a href="user_home.php#Drinks" class="dropdown-item">Drinks</a>
                    <a href="user_home.php#Fruits" class="dropdown-item">Fruits</a>
                    <a href="user_home.php#Oils" class="dropdown-item">Oils</a>
                </div>
            </li>
            <li class="nav-item cart">
                <a class="nav-link text-white" href="#m3" data-backdrop="static" data-toggle="modal"><i class="fa fa-cart-plus fa-x mr-1"></i>Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="user_home.php#con"><i class="fa fa-address-book fa-x mr-1"></i>Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="user_home.php#about"><i class="fa fa-info-circle fa-x mr-1"></i>About us</a>
            </li>
            <li class="nav-item">
                <span class="nav-link dropdown text-white" data-toggle="popover" data-placement="bottom" id="user" title="User profile"><i class="fa fa-user-circle fa-x mr-1"></i><?php echo $_SESSION["name"]; ?></span>
            </li>
        </ul>
    </div>


</nav>