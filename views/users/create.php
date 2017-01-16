<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Înregistrare<br/>
                <small>Completează formularul de mai jos pentru a crea un cont nou</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group<?=$errors['username'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="username">Username:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="username" name="username" value="<?=$old['username']?>">
                        <?php if ($errors['username']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['username']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['password'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="password">Parolă:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="password" name="password">
                        <?php if ($errors['password']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['password']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['confirm_password'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="confirm_password">Confirmă parola:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <?php if ($errors['confirm_password']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['confirm_password']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['email'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="email">Email:</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="email" name="email" value="<?=$old['email']?>">
                        <?php if ($errors['email']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['email']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['first_name'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="first_name">Prenume:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$old['first_name']?>">
                        <?php if ($errors['first_name']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['first_name']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['last_name'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="last_name">Nume:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$old['last_name']?>">
                        <?php if ($errors['last_name']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['last_name']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Înregistrează-te</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
