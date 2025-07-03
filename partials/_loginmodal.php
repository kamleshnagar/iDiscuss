<!-- Modal -->
<div class="modal fade" id="loginmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginmodalLabel">Login to <a href="index.php" class="text-success text-decoration-none">iDiscuss</a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/forum/partials/_handleLogin.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="login_email" class="form-label">Username</label>
                        <input type="text" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="login_pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_pass" name="login_pass">
                    </div>
                    <div id="emailHelp" class="form-text mb-3">Don't have an account. <a href="" class=" text-decoration-none text-success" data-bs-toggle="modal" data-bs-target="#signupmodal">Sign Up</a></div>

                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            </form>
        </div>
    </div>
</div>