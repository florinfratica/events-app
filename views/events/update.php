<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Evenimente<br/>
                <small>Completează formularul de mai jos pentru a edita evenimentul</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group<?=$errors['title'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="title">Titlu:</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="title" value="<?=$old['title']?>">
                        <?php if ($errors['title']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['title']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['theme'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="theme">Temă:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="2" id="theme" name="theme"><?=$old['theme']?></textarea>
                        <?php if ($errors['theme']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['theme']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['speakers'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="speakers">Speakeri:</label>
                    <div class="col-md-9">
                        <select multiple class="form-control" id="speakers" name="speakers[]">
                            <?php foreach ($speakers_options as $speaker): ?>
                                <option<?=in_array($speaker['id'], $old['speakers']) ? ' selected' : ''?> value="<?=$speaker['id']?>"><?=$speaker['first_name'] . ' ' . $speaker['last_name']?></option>
                            <?php endforeach;?>
                        </select>
                        <?php if ($errors['speakers']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['speakers']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group<?=$errors['date'] ? ' has-error has-feedback' : ''?>">
                    <label class="control-label col-md-3" for="date">Dată:</label>
                    <div class="col-md-9">
                        <input type="datetime-local" class="form-control" id="date" name="date" value="<?=$old['date']?>">
                        <?php if ($errors['date']): ?>
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block"><?=$errors['date']?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Editează eveniment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
