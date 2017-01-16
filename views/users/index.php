<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Utilizatori<br/>
                <small>Listă cu toți utilizatorii înregistrați în aplicație</small>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nume</th>
                        <th>Admin</th>
                        <th>Speaker</th>
                        <th>Acțiuni</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?=$user['username']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=$user['first_name'] . ' ' . $user['last_name']?></td>
                            <td><?=$user['admin'] == 'Y' ? '<span class="glyphicon glyphicon-ok-sign"></span>' : ''?></td>
                            <td><?=$user['speaker'] == 'Y' ? '<span class="glyphicon glyphicon-ok-sign"></span>' : ''?></td>
                            <td>
                                <a href="/?page=users&action=update&id=<?=$user['id']?>" class="btn btn-xs btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span> Editează roluri
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
