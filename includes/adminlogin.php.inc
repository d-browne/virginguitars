<div id="contentBox">

    <h1>Admin Area</h1>

    <div id="signInBoxAdmin">
        <fieldset class="signInFieldSet">
            <legend>Sign in</legend>
            <form aciton="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div><label>Email:</label><span class="inputSpan"><input type="text" class="inputTextBox" name="adminEmail"/></span></div>
                <div><label>Password:</label><span class="inputSpan"><input type="password" class="inputTextBox" name="adminPassword"/></span></div>
                <div><label>Remmeber:</label><input type="checkbox" name="remember" checked/></div>
                <input type="submit" value="Sign In" class="formCSSButton" name="submit" value="submit"></input>
            </form>
        </fieldset>
    </div>
</div>