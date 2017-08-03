<h1>RESTORE PASSWORD PAGE</h1>
<div id="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="login-form">
                <form method="post" action="" id="login">
                    <span class="glyphicon glyphicon-home" aria-hidden="true"> For password restore enter your email</span>
                    <div class="btn-default">
                        <?php
                           echo $data;
                        ?> </div>
                    <input type="email" name="email" id="e-mail" placeholder="Email" class="form-control input-lg">
                    <button type="submit" name="btn-login" class="btn-lg btn-primary btn-block">Reset password</button>

                    <div>
                        <a href="/signup">Create account</a> or <a href="/login">Login</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>