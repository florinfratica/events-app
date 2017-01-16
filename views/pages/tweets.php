<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Tweet-uri<br/>
                <small>Ultimele mențiuni ale hashtag-ului <code>#PPC</code> în social media</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php foreach ($tweets as $tweet): ?>
                <div class="media">
                    <div class="media-left">
                        <img src="<?=$tweet->user->profile_image_url?>" class="media-object img-thumbnail" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a target="_blank" href="https://twitter.com/<?=$tweet->user->screen_name?>/status/<?=$tweet->id?>"><?=$tweet->user->screen_name?></a> <small><i>Publicat la <?=date('d-m-Y H:i', strtotime($tweet->created_at))?></i></small></h4>
                        <p><?=$tweet->text?></p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
