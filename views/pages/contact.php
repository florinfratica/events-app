<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Contact<br/>
                <small>Dacă vrei să ne adresezi o întrebare completează formularul de mai jos</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group<?=$errors['message'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="message">Mesaj:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="6" id="message" name="message"><?=$old['message']?></textarea>
                        <?php if ($errors['message']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['message']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Trimite mesajul</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
