<?php if (isset($delete_event)): ?>
    <div class="container">
        <br/>
        <div class="alert alert-danger alert-dismissable" style="margin:0;">
            <a href="?page=events&action=admin" class="close">&times;</a>
            Ești sigur că vrei să ștergi evenimentul <b><?=$delete_event['title']?></b>?
            <a href="/?page=events&action=admin&confirm_delete=<?=$delete_event['id']?>" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-trash"></span> Da, șterge evenimentul
            </a>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Evenimente<br/>
                <small>Listă cu toate evenimentele introduse în aplicație</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Titlu</th>
                        <th>Temă</th>
                        <th>Speakeri</th>
                        <th>Dată</th>
                        <th>Acțiuni</th>
                    </tr>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><a href="?page=events&action=show&id=<?=$event['id']?>"><?=$event['title']?></a></td>
                            <td><?=mb_strimwidth($event['theme'], 0, 50, '...')?></td>
                            <td><?=$event['speaker_1_fullname'] . ', ' . $event['speaker_2_fullname'] . ', ' . $event['speaker_3_fullname']?></td>
                            <td><?=date('d-m-Y H:i', strtotime($event['scheduled_at']))?></td>
                            <td>
                                <a href="/?page=events&action=update&id=<?=$event['id']?>" class="btn btn-xs btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span> Editează
                                </a>
                                <a href="/?page=events&action=admin&delete_id=<?=$event['id']?>" class="btn btn-xs btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Șterge
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
