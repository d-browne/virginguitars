<h1>Sign in</h1>
<div id="newUserBox">
    <fieldset class="signInFieldSet">
        <legend>New User</legend>
        <form action="members.php" method="POST">
            <div><label>Email:</label><span class="inputSpan"><input type="email" class="inputTextBox" name="email" placeholder="example@example.com" /></span></div>
            <div><label>Confirm:</label><span class="inputSpan"><input type="email" class="inputTextBox" name="emailConfirm" placeholder="Confirm email..."/></span></div>
            <div><label>Password:</label><span class="inputSpan"><input type="password" class="inputTextBox" name="password" placeholder="••••••••••"/></span></div>
            <div><label>Confirm:</label><span class="inputSpan"><input type="password" class="inputTextBox" name="passwordConfirm" placeholder="Confirm Password"/></span></div>
            <span class="errorMessage">
                <?php
                    // Check if there was a create error
                    if (isset($createError))
                    {
                        // Display the error
                        echo $createError;
                    }
                ?>
            </span>
            <button class="formCSSButtonButton" name="create" value="create" type="submit">Create</button>
        </form>
    </fieldset>
</div>
<div id="signInBox">
    <fieldset class="signInFieldSet">
        <legend>Sign in</legend>
        <form action="members.php" method="POST">
            <div><label>Email:</label><span class="inputSpan"><input type="email" class="inputTextBox" name="email" placeholder="example@example.com" /></span></div>
            <div><label>Password:</label><span class="inputSpan"><input type="password" class="inputTextBox" name="password" placeholder="••••••••••"/></span></div>
            <?php //<div><label>Remember:</label><input type="checkbox" name="remember" checked/></div> ?>
            <span class="errorMessage">
                <?php
                    // Check if there was a signIn error
                    if (isset($signInError))
                    {
                        // Show the error
                        echo $signInError;
                    }
                ?>
            </span>
            <button class="formCSSButtonButton" type="submit" name="signIn" value="signIn">Sign in</button>
        </form>
    </fieldset>
</div>