<div id="contentBox">

    <h1>Admin Area</h1>

    <div id="signInBoxAdmin">
        <fieldset class="signInFieldSet">
            <legend>Sign in</legend>
            <form action="admin.php" method="POST">
                <div><label>Username:</label><span class="inputSpan"><input type="text" class="inputTextBox" name="adminUsername"/></span></div>
                <div><label>Password:</label><span class="inputSpan"><input type="password" class="inputTextBox" name="adminPassword"/></span></div>
                <?php //<div><label>Remember:</label><input type="checkbox" name="remember" checked/></div> ?>
                <button type="submit" class="formCSSButtonButton" name="submit" value="submit">Sign In</button>
            </form>
        </fieldset>
    </div>
</div>