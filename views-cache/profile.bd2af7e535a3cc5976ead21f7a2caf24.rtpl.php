<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perfil</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <!-- <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="/res/admin2/dist/img/user4-128x128.jpg" alt="User profile picture">
                            </div> -->
                            <h3 class="profile-username text-center"><?php echo htmlspecialchars( $user["employees_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                            <?php require $this->checkTemplate("profile-menu");?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <?php if( $profileMsg != '' ){ ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars( $profileMsg, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>
                    <?php if( $profileError != '' ){ ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars( $profileError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-header p-2">
                            <form class="form-horizontal" method="post" action="/admin/profile">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nome" name="nome"
                                            placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["employees_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deslogin">Login</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-universal-access"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="deslogin" name="deslogin"
                                            placeholder="Digite o login" value="<?php echo htmlspecialchars( $user["deslogin"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="phone">Telefone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="Digite o telefone" value="{}">
                                    </div>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Digite o e-mail" value="{}">
                                    </div>
                                </div> -->
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
    <!-- /.content -->
</div>