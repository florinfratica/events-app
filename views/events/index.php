<?php if (isset($delete_event)): ?>
    <div class="container">
        <br/>
        <div class="alert alert-danger alert-dismissable" style="margin:0;">
            <a href="?page=events&action=index" class="close">&times;</a>
            Ești sigur că vrei să anulezi participarea la evenimentul <b><?=$delete_event['title']?></b>?
            <a href="/?page=events&action=index&confirm_delete=<?=$delete_event['id']?>" class="btn btn-xs btn-danger">
                <span class="glyphicon glyphicon-remove-sign" style="vertical-align: -1px;"></span> Da, anulează partiparea
            </a>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Evenimentele mele<br/>
                <small>Listă cu toate evenimentele la care ești participant sau speaker</small>
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
                                <a href="/?page=events&action=show&id=<?=$event['id']?>" class="btn btn-xs btn-default">
                                    <span class="glyphicon glyphicon-info-sign" style="vertical-align: -1px;"></span> Detalii
                                </a>
                                <?php if (in_array($user_id, [$event['speaker_1'], $event['speaker_2'], $event['speaker_3']])): ?>
                                    <a href="/?page=presentations&action=update&id=<?=$event['id']?>" class="btn btn-xs btn-primary">
                                        <span class="glyphicon glyphicon-file" style="vertical-align: -1px;"></span> Prezentare
                                    </a>
                                <?php else: ?>
                                    <a href="/?page=events&action=index&delete_id=<?=$event['id']?>" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-remove-sign" style="vertical-align: -1px;"></span> Anulează participarea
                                    </a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
