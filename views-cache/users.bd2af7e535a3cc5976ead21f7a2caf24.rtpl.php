<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Lista de Usuários</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item"><a href="/admin/users">Usuários</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <a href="/admin/users/create" class="btn btn-success">Cadastrar Usuário</a>
          </div>
          <hr>


          <div class="box-body no-padding">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <!--<th style="width: 10px">#</th>-->
                  <th>Nome</th>
                  <th>Login</th>
                  <th style="width: 60px">Admin</th>
                  <th style="width: 240px">&nbsp;Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                <tr>
                  <!--<td><?php echo htmlspecialchars( $value1["iduser"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>-->
                  <td><?php echo htmlspecialchars( $value1["employees_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php echo htmlspecialchars( $value1["deslogin"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  <td><?php if( $value1["id_profile"] == \Hcode\Model\Perfil::Administrador ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                  <td>
                    <a href="/admin/users/<?php echo htmlspecialchars( $value1["id_employees"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
                      Editar</a>
                    <a href="/admin/users/<?php echo htmlspecialchars( $value1["id_employees"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/password" class="btn btn-default btn-xs"><i
                        class="fa fa-unlock"></i> Alterar Senha</a>
                    <a href="/admin/users/<?php echo htmlspecialchars( $value1["id_employees"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete"
                      onclick="return confirm('Deseja realmente excluir este registro?')"
                      class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->


        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->