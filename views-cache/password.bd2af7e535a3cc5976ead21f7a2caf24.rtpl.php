<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Senha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Senha</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="/res/admin2/dist/img/user4-128x128.jpg" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo getUserName(); ?></h3>
                            <?php require $this->checkTemplate("profile-menu");?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <?php if( $changePassError != '' ){ ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars( $changePassError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>

                    <?php if( $changePassSuccess != '' ){ ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars( $changePassSuccess, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-header p-2">
                            <form class="form-horizontal" method="post" action="/admin/password">
                                <div class="form-group">
                                    <label for="current_pass">Senha Atual</label>
                                    <input type="password" class="form-control" id="current_pass" name="current_pass">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="new_pass">Nova Senha</label>
                                    <input type="password" class="form-control" id="new_pass" name="new_pass">
                                </div>
                                <div class="form-group">
                                    <label for="new_pass_confirm">Confirme a Nova Senha</label>
                                    <input type="password" class="form-control" id="new_pass_confirm"
                                        name="new_pass_confirm">
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>

                            </form>
                        </div><!-- /.card-header -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>






</div>