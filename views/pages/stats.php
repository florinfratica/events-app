<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Statistici generale</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=User::count()?></div>
                            <div>utilizatori înregistrați</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bullhorn fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=User::countWhere('speaker', 'Y')?></div>
                            <div>speakeri</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=Event::count()?></div>
                            <div>evenimente organizate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-sign-in fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=Attendee::count()?></div>
                            <div>participanți evenimente</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2">Cele mai vizitate pagini</th>
                    </tr>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><a href="<?=$page['page']?>"><?=$page['page']?></a></td>
                            <td><?=$page['views']?> vizualizări</td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2">Cele mai vizualizate evenimente</th>
                    </tr>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><a href="<?=$event['page']?>"><?=$event['event_title']?></a></td>
                            <td><?=$event['views']?> vizualizări</td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
