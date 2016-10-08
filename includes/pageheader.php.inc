<div id="headerBox">
    <?php
        // If admin Display "signed in as admin" label in header box
        if ($_SESSION["isAdmin"]) 
        {
            echo '<div id="signedInAsAdminLink"><a href="admin.php">[Signed in as admin]</a></div>';
        }
    ?>
    <a href="index.php"><img src="images/logo.png" width="213" height="200" alt="Virgin Guitars" class="logoImage"></a>
    <h1 class="mainHeader">Virgin Guitars</h1>
    <form action="search.php" method="GET">
        <input type="text" id="searchBox" name="model" placeholder="Site Search..." value="<?php if (isset($_GET['model']) && basename($_SERVER['PHP_SELF']) === "search.php") { echo htmlspecialchars($_GET['model']); } // Set value if search recieved on search page ?>"/>
    </form>

    <div id="checkOutBox">
        <span id="cartItems"><a href="cart.html">4</a></span>
        <a href="cart.html"><img src="images/cartIcon.png" id="cartIcon" width="32" height="42" alt="Cart"></a>
        <a href="checkout.html" id="checkoutLink">checkout</a>
    </div>
</div>