<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Participanți<br/>
                <small>Listă cu participanții la evenimentul <b><?=$event['title']?></b></small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Job</th>
                    </tr>
                    <?php foreach ($attendees as $user): ?>
                        <tr>
                            <td><?=$user['full_name']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=$user['job_title']?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <a class="btn btn-success" href="?page=attendees&action=export&id=<?=$event['id']?>"><span class="glyphicon glyphicon-floppy-disk"></span> Exportă în document Excel</a>
            <br/><br/><br/>
            <a href="?page=events&action=show&id=<?=$event['id']?>">&laquo; Înapoi la pagina evenimentului</a>

        </div>
    </div>
</div>
