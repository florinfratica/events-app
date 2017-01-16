<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Utilizatori<br/>
                <small>Modifică rolurile lui <b><?=$old['username']?></b></small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label class="control-label col-md-3" for="admin">Admin:</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label><input type="checkbox"<?=$old['admin'] == 'Y' ? ' checked' : ''?> id="admin" name="admin" value="Y">Da, acest utilizator are drepturi de administrator</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="speaker">Speaker:</label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label><input type="checkbox"<?=$old['speaker'] == 'Y' ? ' checked' : ''?> id="speaker" name="speaker" value="Y">Da, acest utilizator are rolul de speaker</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-primary">Editează rolurile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
