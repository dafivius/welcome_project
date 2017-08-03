<h1>Добро пожаловать!</h1>
<div id="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="login-form">
                <form method="post" action="" id="login">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"> Login</span>
                    <div id="error"> <!-- див для fadeOut -->
                        <!-- див для отображения ошибки ! -->
                        <div id="error_span"></div>
                    </div>
                    <input type="email" name="email" id="e-mail" placeholder="Email" class="form-control input-lg">
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control input-lg">
                    <button type="submit" name="btn-login" class="btn-lg btn-primary btn-block">Log me in</button>

                    <div>
                        <a href="/signup">Create account</a> or <a href="#">Reset password</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>