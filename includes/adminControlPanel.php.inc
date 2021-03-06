<div id="contentBox">
    <h1>Admin Area</h1>
    <div class="controlPanelSection" id="firstControlPanelSection">
        <div class="adminControl" id="addStockControl">
            <a href="admin.php?manageStock">
                <div class="adminControlIcon" id="addStockIcon"></div>
                <div class="adminControlCaption">Stock</div>
            </a>
        </div>       
        <div class="adminControl" id="editUserControl">
            <a href="admin.php?manageCustomers">
                <div class="adminControlIcon" id="editUserIcon"></div>
                <div class="adminControlCaption">Customers</div>
            </a>
        </div>             
        <div class="adminControl" id="manageInvoicesControl">
            <a href="admin.php?manageOrders">
                <div class="adminControlIcon" id="manageInvoicesIcon"></div>
                <div class="adminControlCaption">Orders</div>
            </a>
        </div>           
        <div class="adminControl" id="manageFaqControl">
            <a href="admin.php?faq">
                <div class="adminControlIcon" id="manageFaqIcon"></div>
                <div class="adminControlCaption">Edit Faq</div>
            </a>
        </div>
        <div class="adminControl" id="manageAboutUsControl">
            <a href="admin.php?aboutus">
                <div class="adminControlIcon" id="manageAboutUsIcon"></div>
                <div class="adminControlCaption">Edit About Us</div>
            </a>
        </div>
    </div>       
    <div id="signoutDiv" class="controlPanelSection">
        <form action="admin.php" method="GET">
            <button class="formCSSButtonButton" name="logout" value="logout">Sign out</button>
        </form>
    </div>    
</div>