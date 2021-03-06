<div class="container">
    <br/>
    <div class="row">
        <div class="col-md-8">
            <img class="img-responsive img-rounded" src="/assets/images/conference_photo.jpg" alt="">
        </div>
        <div class="col-md-4">
            <h2>Events App</h2>
            <p>Aceasta este o aplicație de organizare și gestiune de evenimente realizată în cadrul cursului opțional <code>Programare web cu PHP şi MySQL</code>.</p>
            <p>Pentru a avea acces la toate funcționalitățile site-ului dă click pe butonul mai jos și creează-ți un cont sau conectează-te cu un cont deja existent completând formularul din partea de sus a paginii.</p>
            <a class="btn btn-primary btn-lg" href="/?page=users&action=create">Creează un cont nou!</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="well text-center">
                Mai jos este o listă cu evenimentele care vor avea loc în curând. Poți intra pe pagina evenimentului pentru a afla mai multe detalii.
            </div>
        </div>
    </div>
    <div class="row text-center">
        <?php foreach ($next as $key => $event): ?>
            <div class="col-md-4<?=$key == 2 ? ' col-md-offset-0' : ''?> col-sm-6<?=$key == 2 ? ' col-sm-offset-3' : ''?> hero-feature">
                <div class="thumbnail">
                    <img src="/uploads/<?=$event['image']?>" alt="">
                    <div class="caption">
                        <h3><a href="?page=events&action=show&id=<?=$event['id']?>"><?=$event['title']?></a></h3>
                        <div class="clearfix">
                            <h4 class="pull-left">
                                <span class="glyphicon glyphicon-calendar" style="font-size:16px;vertical-align:-2px;margin-right:3px;"></span><small><?=date('d-m-Y H:i', strtotime($event['scheduled_at']))?></small>
                            </h4>
                            <h4 class="pull-right">
                                <span class="glyphicon glyphicon-user" style="font-size:16px;vertical-align:-2px;margin-right:3px;"></span><small><?=Attendee::eventCount($event['id'])?> participanți</small>
                            </h4>
                        </div>
                        <p><?=$event['theme']?></p>
                        <p>
                            <a href="?page=events&action=show&id=<?=$event['id']?>" class="btn btn-default">Mai multe informații</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
