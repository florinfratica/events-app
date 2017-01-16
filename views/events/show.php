<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <?=$event['title']?>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <img class="img-responsive img-thumbnail" src="/uploads/<?=$event['image']?>" alt="">
        </div>
        <div class="col-md-7">
            <h3>Temă</h3>
            <p><?=$event['theme']?></p>
            <h3>Dată</h3>
            <span class="glyphicon glyphicon-calendar" style="font-size:16px;vertical-align:-2px;margin-right:3px;"></span><?=date('d-m-Y H:i', strtotime($event['scheduled_at']))?>
            <h3>Speakeri</h3>
            <ul>
                <li><?=$event['speaker_1_fullname']?> — <code><?=$event['speaker_1_email']?></code></li>
                <li><?=$event['speaker_2_fullname']?> — <code><?=$event['speaker_2_email']?></code></li>
                <li><?=$event['speaker_3_fullname']?> — <code><?=$event['speaker_3_email']?></code></li>
            </ul>
        </div>
    </div>
    <br/><br/>
    <div class="btn-group btn-group-justified">
        <a href="?page=attendees&action=show&id=<?=$event['id']?>" class="btn btn-primary">Vezi lista participanților (<?=Attendee::eventCount($event['id'])?> participanți)</a>
        <?php if (isset($_SESSION['auth_id'])): ?>
            <?php if (strtotime($event['scheduled_at']) > time() && !in_array($_SESSION['auth_id'], array($event['speaker_1'], $event['speaker_2'], $event['speaker_3'])) && Attendee::countWhere($_SESSION['auth_id'], $event['id']) == 0): ?>
                <a href="?page=attendees&action=create&id=<?=$event['id']?>" class="btn btn-primary">Înregistrează-te ca participant!</a>
            <?php endif;?>
        <?php endif;?>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Prezentări</h3>
        </div>
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="col-md-4<?=$i == 3 ? ' col-md-offset-0' : ''?> col-sm-6<?=$i == 3 ? ' col-sm-offset-3' : ''?> text-center">
                <img class="img-circle img-responsive img-center" src="<?=($event['speaker_' . $i . '_avatar']) ? '/uploads/avatars/' . $event['speaker_' . $i . '_avatar'] : '/assets/images/avatar_placeholder.png'?>" alt="">
                <h3><?=$event['speaker_' . $i . '_fullname']?> <small><?=$event['speaker_' . $i . '_jobtitle']?></small></h3>
                <p><?=$event['speaker_' . $i . '_presentation']?></p>
            </div>
        <?php endfor;?>
    </div>

</div>
