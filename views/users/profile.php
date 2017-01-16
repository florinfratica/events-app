<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Profil<br/>
                <small>Modifică profilul tău</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group<?=$errors['job_title'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="job_title">Job:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="job_title" name="job_title" value="<?=$old['job_title']?>">
                        <?php if ($errors['job_title']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['job_title']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['avatar'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="avatar">Avatar:</label>
                    <div class="col-md-9">
                        <input type="file" id="avatar" name="avatar">
                        <span class="help-block">Dimensiune: 200x200px. <?=$errors['avatar']?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Actualizează profilul</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
