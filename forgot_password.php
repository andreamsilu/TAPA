<?php include('titleIcon.php'); ?>

<style>
    /* Custom styles */
    img {
        max-width: 100%;
        height: auto;
    }

    .container {
        margin-top: 50px;
    }

    .content {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 20px;
    }

    #login {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        color: #333;
    }

    .input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .primary-action {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .primary-action:hover {
        background-color: #0056b3;
    }

    .secondary-action {
        background-color: transparent;
        border: none;
        color: #007bff;
        cursor: pointer;
        transition: color 0.3s;
    }

    .secondary-action:hover {
        color: #0056b3;
    }

    .underline {
        text-decoration: underline;
    }

    .color-black {
        color: #000;
    }

    .color-black-50 {
        color: #666;
    }

    .text-center {
        text-align: center;
    }

    .mb-25 {
        margin-bottom: 25px;
    }

    .w-100 {
        width: 100%;
    }
</style>

<div class="container">
    <div class="content">
        <div id="login" class="d-flex justify-content-center align-items-center flex-column position-relative">
            <div class="w-100 mb-20">
                <div class="text-center mb-25 w-100">
                    <img src="assets/img/login/password-reset.svg" class="w-100" alt="Reset password">
                </div>
                <h3 class="mb-25 text-center title">Reset Your Password</h3>
                <span class="social-login-block w-100">
                </span>
                <form method="post" action="send_reset_link.php" class="d-flex justify-content-center align-items-center flex-column w-100 text-center">
                    <input type="hidden" name="_token" value="exkHGDHovZRtTRIqdRL5lx7JHSS2aa7cKRPJbxDU" autocomplete="off">
                    <div class="mb-25 w-100">
                        <input id="email-input" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="email" type="email" autocomplete="email" class="input color-black" placeholder="Email" required>
                        <input style="display: none !important" id="backup-email-input" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="backup_email" type="email" autocomplete="email" class="input color-black" placeholder="Backup Email">
                    </div>
                    <button type="submit" class="mb-25 w-100 primary-action background-color-hostinger" data-qa="send-reset-email-button">Send Reset Email</button>
                    <button style="display: none !important" id="backup-email-toggle-button" class="mb-25 button secondary-action color-hostinger">Use Backup Email</button>
                </form>
                
                <div class="text-center color-black">
                    <a href="login.php" class="mb-25 underline fs-12 color-black-50" data-qa="back-to-login-link">Back to log in form</a>
                </div>
            </div>
        </div>
    </div>
</div>
