<?php
$pageTitle = "Administration";
require_once("php/tools.php");
require_once("segments/head.php");
require_once("segments/header.php");

if(isset($_SESSION['user'])) {
    require_once("segments/nav.php");
    // destroying session after 45 minutes of user login
    if(time() - $_SESSION['login_time'] > 2700) {
        session_unset();
        session_destroy();
    }
}
?>
        <!-- display login form if user is not logged in -->
        <?php if (!isset($_SESSION['user'])): ?>
        <section class="login-form-container">
            <span id="login-error"><?php echo $loginError; ?></span>
            <form method="post" action="administration.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $usernameInput; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $passwordInput; ?>" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </section>
        <?php else: ?>
        <!-- display admin page if user is logged in -->
        <main>
            <h1>Welcome <?php echo $_SESSION['user']['username']; ?>!</h1>
            <div id="data-table">
                <p>Here is a list of booking requests made so far</p>
                <table>
                    <thead>
                        <tr>
                            <th><?php echo implode('</th><th>', $bookingTableColumnNames); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['bookingArray'] as $row): array_map('htmlentities', $row); ?>
                        <tr>
                            <td><?php echo implode('</td><td>', $row); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <section id="register" class="register-form-container">
                <h3><b>Register a new user</b></h3><br>
                <span id="login-error"><?php echo $loginError; ?></span>
                <span id="form-success"><?php echo $formSuccess; ?></span>
                <form method="post" action="administration.php">
                    <div class="form-group">
                        <label for="fullname">Full name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullnameInput; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $usernameInput; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $passwordInput; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="<?php echo $confirmPasswordInput; ?>" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </section>
        </main>
        <?php endif ?>

<?php require_once("segments/footer.php"); ?>