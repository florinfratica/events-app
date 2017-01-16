<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Prezentare<br/>
                <small>Editează prezentarea pentru evenimentul <b><?=$event['title']?></b></small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group<?=$errors['presentation'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="presentation">Temă:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="2" id="presentation" name="presentation"><?=$old['presentation']?></textarea>
                        <?php if ($errors['presentation']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['presentation']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Editează prezentarea</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
