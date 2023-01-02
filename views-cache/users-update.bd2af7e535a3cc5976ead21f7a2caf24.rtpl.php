<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="col-sm-6">
    <h1>Editar Usuários</h1>
  </div>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/<?php echo htmlspecialchars( $user["id_employees"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="nome">Nome</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
              <input type="text" class="form-control" id="employees_name" name="employees_name" placeholder="Digite o nome" value="<?php echo htmlspecialchars( $user["employees_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> ">
              </div>
            </div>

            <div class="form-group">
              <label for="phone">Função</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="tel" class="form-control" id="employees_function" name="employees_function" placeholder="Digite o telefone"  value="<?php echo htmlspecialchars( $user["employees_function"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>

            <div class="form-group">
              <label for="deslogin">Login</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-universal-access"></i></span>
                </div>
              <input type="text" class="form-control" id="deslogin" name="deslogin" placeholder="Digite o login"  value="<?php echo htmlspecialchars( $user["deslogin"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            </div>
            
          
            <div class="checkbox">
              <label>
                <input type="checkbox" name="id_profile" value="1" <?php if( $user["id_profile"] == \Hcode\Model\Perfil::Administrador ){ ?>checked<?php } ?>> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->