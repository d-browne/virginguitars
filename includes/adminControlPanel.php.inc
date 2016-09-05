<div id="contentBox">
    <h1>Admin Area</h1>
    <div class="controlPanelSection" id="firstControlPanelSection">
        <div class="adminControl" id="addStockControl">
            <a href="">
                <div class="adminControlIcon" id="addStockIcon"></div>
                <div class="adminControlCaption">New Stock</div>
            </a>
        </div>       
        <div class="adminControl" id="editUserControl">
            <a href="">
                <div class="adminControlIcon" id="editUserIcon"></div>
                <div class="adminControlCaption">Manage Members</div>
            </a>
        </div>             
        <div class="adminControl" id="manageInvoicesControl">
            <a href="">
                <div class="adminControlIcon" id="manageInvoicesIcon"></div>
                <div class="adminControlCaption">Manage Invoices</div>
            </a>
        </div>           
        <div class="adminControl" id="manageFaqControl">
            <a href="admin.php?faq">
                <div class="adminControlIcon" id="manageFaqIcon"></div>
                <div class="adminControlCaption">Edit Faq</div>
            </a>
        </div>            
    </div>       
    <div id="signoutDiv" class="controlPanelSection">
        <form action="admin.php" method="GET">
            <button class="formCSSButtonButton" name="logout" value="logout">Sign out</button>
        </form>
    </div>    
</div>