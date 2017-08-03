
<div id="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="login-form">
                <form method="post" action="" id="signup">
                    <span class="glyphicon glyphicon-import" aria-hidden="true"></span> Sign Up
                    <div id="error"> <!-- див для fadeOut -->
                        <!-- див для отображения ошибки ! -->
                        <div id="error_span"></div>
                    </div>
                    <input type="email" name="email" id="email" placeholder="Email" required class="form-control input-lg">
                    <input type="password" name="password" id="password" placeholder="Password" required class="form-control input-lg">
<!--                    <input type="password" name="password" placeholder="Password again" required class="form-control input-lg">-->
                    <button type="submit" name="go" class="btn-lg btn-primary btn-block">Register</button>

                    <div>
                        <a href="/login">Login</a> or <a href="#">Reset password</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>