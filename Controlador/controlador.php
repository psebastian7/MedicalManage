<?php
require_once(__DIR__.'/../Modelo/medico.php');
include_once(__DIR__.'/../Modelo/usuario.php');
include_once(__DIR__.'/../Modelo/secretario.php');
include_once(__DIR__.'/../Modelo/administrador.php');




class Controlador{


    
 
public function registrarEmpresaController(){
  if(isset($_POST["empresaRegistro"]) && isset($_SESSION["id_admin"])){
    $datosController = array("nombre"=>$_POST["nombreEmpresa"],"direccion"=>$_POST["direccionEmpresa"],"region"=>$_POST["region"],"comuna"=>$_POST["comuna"], "admin" => $_SESSION["id_admin"]);
    $respuesta = new Administrador();
    $respuesta->registrarEmpresa($datosController);

  }
}

public function listarEmpresasController(){
  $respuesta =Administrador::listarEmpresas();
  foreach($respuesta as $row => $item){
      echo "<tr>
                  <td>".$item["nombreEmpresa"]."</td>
                  <td>".$item["regionEmpresa"]."</td>
                  <td>".$item["comunaEmpresa"]."</td>
                  <td><a  href='detalleEmpresa.php?action=&idEmpresa=".base64url_encode($item["id_empresa"]."".$item["nombreEmpresa"])."'><button class='btm btn-dark'  >Ver </button></a> 

              </tr>";
          }
}
public function detalleEmpresaController(){
if(isset($_GET["idEmpresa"])){
  $id = base64url_decode($_GET["idEmpresa"]);

  $respuesta =Administrador::verDetalleEmpresa($id);
  foreach($respuesta as $row => $item){
    echo "
    <div class='table-responsive'>
    <table >
    <tr>
    <th >Nombre</th>
    <th class='pl-4'>Dirección</th>
    <th class='pl-4'>Región</th>
    <th class='pl-4'>Comuna</th>

    </tr>
     <tr>
              <td >  ".$item["nombreEmpresa"]."</td>
              <td class='pl-4'>  ".$item["direccionEmpresa"]."</td>
              <td class='pl-4'>  ".$item["regionEmpresa"]."</td>
              <td class='pl-4'> ".$item["comunaEmpresa"]."</td>
    </tr>
   </table>
</div>
            ";

        }

}

}

public function listarEspecialidadController(){
  $respuesta =Administrador::listarEspecialidad();
  foreach($respuesta as $row => $item){
      echo "
      <option value='".$item['id_especialidad']."'>".$item['nombreEspecialidad']."</option>";

          }
          
}
public function registrarUsuarioConctroller(){
   //Crypt : Devolvera el hash de un algoritmo


	if(isset($_POST["adminRegistro"])){
    $encriptar =crypt($_POST["passAdmin"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

    $datosController = array("rut"=>$_POST["rutAdmin"],"nombre"=>$_POST["nombreAdmin"],"apellido" =>$_POST["apellidoAdmin"],"telefono"=>$_POST["telefonoAdmin"],"correo"=>$_POST["emailAdmin"],"password"=>$encriptar,"tipoUsuario"=> 1);
    $respuesta = new Administrador();
    $respuesta->registrarAdmin($datosController);

  }
  if(isset($_POST["medicoRegistro"]) && isset($_GET["idEmpresa"])){
    $encriptar =crypt($_POST["passMedico"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
      $datosController = array("rut"=>$_POST["rutMedico"],"nombre"=>$_POST["nombreMedico"],"apellido" =>$_POST["apellidoMedico"],"telefono"=>$_POST["telefonoMedico"],"correo"=>$_POST["emailMedico"],"password"=>$encriptar,"tipoUsuario"=> 2,"empresa" =>base64url_decode($_GET["idEmpresa"]),"especialidad"=>$_POST["especialidad"]);
      $respuesta = new Administrador();
      $respuesta->registrarMedico($datosController);
  

  }
  if(isset($_POST["secretarioRegistro"]) && isset($_SESSION["empresa"]) && isset($_SESSION["id_medico"])){
    $encriptar =crypt($_POST["passSecretario"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

    $datosController = array("rut"=>$_POST["rutSecretario"],"nombre"=>$_POST["nombreSecretario"],"apellido" =>$_POST["apellidoSecretario"],"telefono"=>$_POST["telefonoSecretario"],"correo"=>$_POST["emailSecretario"],"password"=>$encriptar,"tipoUsuario"=> 3, "empresa"=>$_SESSION["empresa"],"medico"=>$_SESSION["id_medico"]);
    $respuesta = new Medico();
    $respuesta->registrarSecretario($datosController);

  }
			

     
               

                
        
        
            
        
}
public function listarMedicosEmpresaController(){
if(isset($_GET["idEmpresa"])){
  $id =base64_decode($_GET["idEmpresa"]);
  $respuesta =Administrador::listarMedicosEmpresa($id);
  foreach($respuesta as $row => $item){
    echo "<tr>
                <td>".$item["rutUsuario"]."</td>
                <td>".$item["correoUsuario"]."</td>
                <td>".$item["nombreEspecialidad"]."</td>
                <td>                 
               <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_usuario"])."'>
              Ver
            </button>  </td>
              <div class='modal fade' id='borrar".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
              <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h5 class='modal-title'>Borrar usuario</h5>
                  </div>
                  <div class='modal-body'>
                  <p> ¿Deseas eliminar el siguiente usuario: ".$item["rutUsuario"]."?</p>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    <form method='POST'>
                    <input type='hidden' name='borrarAdmin' value='".$item["id_usuario"]."'
                    <div class='form-group'>
                    <input type='submit' name='borrarAdminB' class='btn btn-danger' value='Borrar'>
                    </div>
                    </form>
                    </div>
                </div>
              </div>
            </div>
            <div class='modal fade' id='edit".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title'>Detalle médico</h5>
                </div>
                <div class='modal-body'>
                    <div class='container'>
                    <div class='row'>
                    <div class='col'>
                    <form method='POST'>
                    <input type='hidden' class='form-control' name='' value='".$item["id_usuario"]."' >
                        <div class='form-group'>
                        <label >RUT </label>
                        <input type='text' class='form-control' name='' value='".$item["rutUsuario"]."' disabled>
                    </div>
                    <div class='form-group'>
                      <label >Nombre </label>
                      <input type='text' class='form-control' name='' value='".$item["nombreUsuario"]."' disabled>
                    </div>
                    <div class='form-group'>
                    <label >Apellido </label>
                    <input type='text' class='form-control' name='' value='".$item["apellidoUsuario"]."' disabled >
                  </div>

                <div class='form-group'>
                <label >Telefono </label>
                <input type='text' class='form-control' name='' value='".$item["telefonoUsuario"]."' disabled>
              </div>
                <div class='form-group'>
                <label >Correo </label>
                <input type='text' class='form-control' name='' value='".$item["correoUsuario"]."'disabled >
              </div>
              <div class='form-group'>
              <label >Especialidad </label>
              <input type='text' class='form-control' name='' value='".$item["nombreEspecialidad"]."'disabled >
            </div>
              
               

                 

                  </form>

                    </div>
                    
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                </div>
              </div>
            </div>
          </div>
            </tr>
                ";

        }
    }
}

    public function listarAdminsController(){
      if(isset($_SESSION["id_admin"])){
        $id = $_SESSION["id_admin"];
        $respuesta =Administrador::listarAdmins($id);
        foreach($respuesta as $row => $item){
            echo "<tr>
                        <td>".$item["rutUsuario"]."</td>
                        <td>".$item["nombreUsuario"]."</td>
                        <td>".$item["apellidoUsuario"]."</td>
                        <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrar".str_replace(' ','',$item["id_usuario"])."'>
                        Borrar
                      </button>                  
                       <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_usuario"])."'>
                      Ver
                    </button>  </td>
                      <div class='modal fade' id='borrar".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title'>Borrar usuario</h5>
                          </div>
                          <div class='modal-body'>
                          <p> ¿Deseas eliminar el siguiente usuario: ".$item["rutUsuario"]."?</p>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                            <form method='POST'>
                            <input type='hidden' name='borrarAdmin' value='".$item["id_usuario"]."'
                            <div class='form-group'>
                            <input type='submit' name='borrarAdminB' class='btn btn-danger' value='Borrar'>
                            </div>
                            </form>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class='modal fade' id='edit".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title'>Detalle Admin</h5>
                        </div>
                        <div class='modal-body'>
                            <div class='container'>
                            <div class='row'>
                            <div class='col'>
                            <form method='POST'>
                            <input type='hidden' class='form-control' name='' value='".$item["id_usuario"]."' >
                                <div class='form-group'>
                                <label >RUT </label>
                                <input type='text' class='form-control' name='' value='".$item["rutUsuario"]."' disabled>
                            </div>
                            <div class='form-group'>
                              <label >Nombre </label>
                              <input type='text' class='form-control' name='' value='".$item["nombreUsuario"]."' disabled>
                            </div>
                            <div class='form-group'>
                            <label >Apellido </label>
                            <input type='text' class='form-control' name='' value='".$item["apellidoUsuario"]."' disabled >
                          </div>

                        <div class='form-group'>
                        <label >Telefono </label>
                        <input type='text' class='form-control' name='' value='".$item["telefonoUsuario"]."' disabled>
                      </div>
                        <div class='form-group'>
                        <label >Correo </label>
                        <input type='text' class='form-control' name='' value='".$item["correoUsuario"]."'disabled >
                      </div>
                      
                       

                         

                          </form>

                            </div>
                            
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                    </tr>";
                }
      }
    }
    public function listarSecretariosController(){
      if(isset($_SESSION["id_medico"])){
        $id = $_SESSION["id_medico"];
        $respuesta =Medico::listarSecretarios($id);
        foreach($respuesta as $row => $item){
            echo "<tr>
                        <td>".$item["rutUsuario"]."</td>
                        <td>".$item["nombreUsuario"]."</td>
                        <td>".$item["apellidoUsuario"]."</td>
                        <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrar".str_replace(' ','',$item["id_usuario"])."'>
                        Borrar
                      </button>                  
                       <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_usuario"])."'>
                      Ver
                    </button>  </td>
                      <div class='modal fade' id='borrar".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title'>Borrar usuario</h5>
                          </div>
                          <div class='modal-body'>
                          <p> ¿Deseas eliminar el siguiente usuario: ".$item["rutUsuario"]."?</p>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                            <form method='POST'>
                            <input type='hidden' name='borrarSecretario' value='".$item["id_usuario"]."'
                            <div class='form-group'>
                            <input type='submit' name='borrarSecretarioB' class='btn btn-danger' value='Borrar'>
                            </div>
                            </form>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class='modal fade' id='edit".str_replace(' ','',$item["id_usuario"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title'>Detalle Secretario</h5>
                        </div>
                        <div class='modal-body'>
                            <div class='container'>
                            <div class='row'>
                            <div class='col'>
                            <form method='POST'>
                            <input type='hidden' class='form-control' name='' value='".$item["id_usuario"]."' >
                                <div class='form-group'>
                                <label >RUT </label>
                                <input type='text' class='form-control' name='' value='".$item["rutUsuario"]."' disabled>
                            </div>
                            <div class='form-group'>
                              <label >Nombre </label>
                              <input type='text' class='form-control' name='' value='".$item["nombreUsuario"]."' disabled>
                            </div>
                            <div class='form-group'>
                            <label >Apellido </label>
                            <input type='text' class='form-control' name='' value='".$item["apellidoUsuario"]."' disabled >
                          </div>

                        <div class='form-group'>
                        <label >Telefono </label>
                        <input type='text' class='form-control' name='' value='".$item["telefonoUsuario"]."' disabled>
                      </div>
                        <div class='form-group'>
                        <label >Correo </label>
                        <input type='text' class='form-control' name='' value='".$item["correoUsuario"]."'disabled >
                      </div>
                      
                       

                         

                          </form>

                            </div>
                            
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                    </tr>";
                }
      }
      
    }

    public function cuentaUsuarioController(){
      if(isset( $_GET["idCuenta"])){
        
        $id = base64url_decode( $_GET["idCuenta"]);
        
          //  $datosController = array();
            $respuesta =Usuario::verCuentaUsuario($id);
            foreach($respuesta as $row => $item){
              echo " 
              
              <form method='post' >
              <div class='form-group'><input class='form-control' type='hidden' name='idEditarCuenta' id='idEditarCuenta'  value='".$item["id_usuario"]."' >  
              <div class='form-group'><label for='rutLabel'>RUT</label><input class='form-control' type='text' name='rutUsuario' id='rutUsuario' data-field='rutUser'  value='".$item["rutUsuario"]."' disabled >  <div class='valid-message'></div></div>
                          <div class='form-group'><label for='nombreLabel'>Nombre</label><input class='form-control' type='text' name='nombreUsuario' id='nombreUsuario' data-field='nombreUs' value='".$item["nombreUsuario"]."' disabled> <div class='valid-message'></div></div>
                          <div class='form-group'><label for='apellidoLabel'>Apellido</label><input class='form-control' type='text' name='apellidoUsuario' id='apellidoUsuario' data-field='apeUs' value='".$item["apellidoUsuario"]."' disabled>  <div class='valid-message'></div></div>
                          <div class='form-group'><label for='telefonoLabel'>Telefono</label><input class='form-control' type='tel' name='telefonoUsuarioC' id='telefonoUsuario' data-field='telUs' value='".$item["telefonoUsuario"]."' > <div class='valid-message'></div></div>
                          <div class='form-group'><label for='emailLabel'>Correo</label><span></span><input class='form-control' type='email' name='emailUsuarioC' id='emailUsuario' data-field='emailUs' value='".$item["correoUsuario"]."'> <div class='valid-message'></div></div>
                          <div class='form-group'><label for='passLabel'>Contraseña</label><input class='form-control' type='password' name='passUsuario'id='passUsuario' value='".$item["passwordUsuario"]."' data-field='passUs' disabled> <a href='pass.php?action=&idCuenta=".base64url_encode($item["id_usuario"]."".$item["nombreUsuario"])."'>Cambiar contraseña</a><div class='valid-message'></div></div>          
                          <button class='btn btn-primary'
                                  type='submit' id='modificarCuenta' style='margin-top: 30px;' name='modificarCuenta'>Modificar</button></div>
              </form>         
              
              
              
              
              ";
            }
          }
    }
    public function contraseñaCuentaController(){
      if(isset($_GET["idCuenta"])){
        
        $id = base64url_decode($_GET["idCuenta"]);
          //  $datosController = array();
            $respuesta =Usuario::verCuentaUsuario($id);
            foreach($respuesta as $row => $item){
              echo " 
  
              <form method='post' >
              <div class='form-group'><input class='form-control' type='hidden' name='idEditarCuenta' id='idEditarCuenta'  value='".$item["id_usuario"]."' >  
                          <div class='form-group'><label for='emailLabel'>Correo</label><span></span><input class='form-control' type='email' name='emailUsuarioC' id='emailUsuario' data-field='emailUs' value='".$item["correoUsuario"]."' disabled> <div class='valid-message'></div></div>
                          <div class='form-group'><label for='passLabel'>Antigua contraseña</label><input class='form-control' type='password' name='passUsuario'id='passUsuario' value='".$item["passwordUsuario"]."' data-field='passUs' disabled>         
                          <div class='form-group'><label for='passLabel'>Nueva Contraseña</label><input class='form-control' type='password' name='passUsuarioN'id='passUsuarioN'  data-field='passUs' >         
                          <div class='form-group'><label for='passLabel'>Confirmar Contraseña</label><input class='form-control' type='password' name='passUsuarioN2'id='passUsuarioN2'  data-field='passUs' >         
                          <div id='coincidencia' class='bg-secondary text-light'></div>
                          <button class='btn btn-primary'
                                  type='submit' id='cambiarPass' style='margin-top: 30px;' name='cambiarPass'>Modificar</button></div>
              </form>         
              
              
              
              ";
            }
          }

    }
    public function editarContraseñaCuentaController(){
      if( isset($_POST["cuenta"])){

        $id = $_POST["idEditarCuenta"];
        $nueva = $_POST["passUsuarioN"];
        $nueva2 = $_POST["passUsuarioN2"];

        if($nueva == $nueva2){
          $encriptar =crypt($nueva2,'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $respuesta = new Usuario();
          $respuesta->editarContraseñaCuenta($id,$encriptar);
          if(isset($_SESSION["id_admin"])){
            header("location:cuenta.php?action=&idCuenta=".base64url_encode($_SESSION["id_admin"])."'");

          }
          if(isset($_SESSION["id_medico"])){
            header("location:cuenta.php?action=&idCuenta=".base64url_encode($_SESSION["id_medico"])."'");

          }
       
          if(isset($_SESSION["id_secretario"])){
            header("location:cuenta.php?action=&idCuenta=".base64url_encode($_SESSION["id_secretario"])."'");

          }
        }

        

      }

    }
    public function editarCuentaUsuarioController(){

      if( isset($_POST["modificarCuenta"])){

          $id = $_POST["idEditarCuenta"];
          $datosController = array("telefono"=>$_POST["telefonoUsuarioC"],"correo"=>$_POST["emailUsuarioC"]);
        
          
          $respuesta = new Usuario();
          $respuesta->editarCuentaUsuario($id,$datosController);



           
           
      }
  }
    
    public function borrarAdminController(){
        if(isset($_POST["borrarAdminB"])){
            $datosController = $_POST["borrarAdmin"];
            $respuesta = new Administrador();
            $respuesta->borrarAdmin($datosController);            
        }
    }
    public function borrarSecretarioController(){
      if(isset($_POST["borrarSecretarioB"])){
          $datosController = $_POST["borrarSecretario"];
          $respuesta = Medico::borrarSecretario($datosController);            
      }
  }

  
    public function registrarExamenController(){


      if(isset($_POST["exaRegistro"])){
              
  
              
                  $datosController = array("nombre"=>$_POST["exaNombre"],"descripcion" =>$_POST["exaDes"]);
                      $respuesta = new Medico();
                      $respuesta->registrarExamen($datosController);
              
          }
  }
  public function listarExamenesController(){
    $respuesta =Medico::listarExamenes();
    foreach($respuesta as $row => $item){
        echo "<tr>
                    <td>".$item["nombreExamen"]."</td>
                    <td>".$item["descripcion"]."</td>
                   <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#".str_replace(' ','',$item["nombreExamen"])."'>
                    Borrar
                  </button>                    
                 <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_examen"])."'>
                  Editar
                </button>  </td>
                  <div class='modal fade' id='".str_replace(' ','',$item["nombreExamen"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title'>Modal title</h5>
                      </div>
                      <div class='modal-body'>
                      <p> ¿Deseas eliminar el siguiente medicamento: ".$item["nombreExamen"]."?</p>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>

                        <form method='POST'>
                        <input type='hidden' name='borrarMed' value='".$item["id_examen"]."'
                        <div class='form-group'>
                        <input type='submit' name='borrarMedB' class='btn btn-danger' value='Borrar'>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='modal fade' id='edit".str_replace(' ','',$item["id_examen"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title'>Editar examen</h5>
                    </div>
                    <div class='modal-body'>
                        <div class='container'>
                        <div class='row'>
                        <div class='col'>
                        <form method='POST'>
                        <input type='hidden' class='form-control' name='idEditarMed' value='".$item["id_examen"]."' >

                        <div class='form-group'>
                          <label >Nombre </label>
                          <input type='text' class='form-control' name='editNombreMed' value='".$item["nombreExamen"]."' >
                        </div>

                      <div class='form-group'>
                      <label >Descripción </label>
                      <input type='text' class='form-control' name='editDes' value='".$item["descripcion"]."' >
                      </div>
                      <div class='form-group'>
                      <input type='submit' name='editarMed' class='btn btn-primary' value='Editar'>
                      </div>

                      </form>

                        </div>
                        
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
                  
               
                </tr>
                
                
                ";
                
            }
   
            
      
   
}
public function listarExamenesConsultaController(){
  $respuesta =Medico::listarExamenesPaciente();
  foreach($respuesta as $row => $item){
      echo "
      <option value='".$item['nombreExamen']."'>".$item['nombreExamen'].")</option>";

          }
 
}




    public function registrarMedicamentoController(){


        if(isset($_POST["medRegistro"]) && isset($_SESSION["id_medico"])){
                
    
                
                    $datosController = array("nombre"=>$_POST["medNombre"],"miligramos"=>$_POST["medMil"],"descripcion" =>$_POST["medDes"], "medico"=>$_SESSION["id_medico"]);
                        $respuesta = new Medico();
                        $respuesta->registrarMedicamento($datosController);
                
            }
    }

    public function listarMedicamentosController(){

      if(isset($_SESSION["id_medico"])){
        $id = $_SESSION["id_medico"];
        $respuesta =Medico::listarMedicamentos($id);
        foreach($respuesta as $row => $item){
            echo "<tr>
                        <td>".$item["nombreMedicamento"]."</td>
                        <td>".$item["miligramos"]."</td>
                       <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#".str_replace(' ','',$item["nombreMedicamento"])."'>
                        Borrar
                      </button>                    
                     <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_medicamento"])."'>
                      Editar
                    </button>  </td>
                      <div class='modal fade' id='".str_replace(' ','',$item["nombreMedicamento"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title'>Modal title</h5>
                          </div>
                          <div class='modal-body'>
                          <p> ¿Deseas eliminar el siguiente medicamento: ".$item["nombreMedicamento"]."?</p>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>

                            <form method='POST'>
                            <input type='hidden' name='borrarMed' value='".$item["id_medicamento"]."'
                            <div class='form-group'>
                            <input type='submit' name='borrarMedB' class='btn btn-danger' value='Borrar'>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class='modal fade' id='edit".str_replace(' ','',$item["id_medicamento"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title'>Editar medicamento</h5>
                        </div>
                        <div class='modal-body'>
                            <div class='container'>
                            <div class='row'>
                            <div class='col'>
                            <form method='POST' id='medEdit'>
                            <input type='hidden' class='form-control' name='idEditarMed' value='".$item["id_medicamento"]."' >

                            <div class='form-group'>
                              <label >Nombre </label>
                              <input type='text' class='form-control' name='editNombreMed' id='medNombre' value='".$item["nombreMedicamento"]."' data-field='editNombreMed' >
                             <div class='valid-message'></div>
                            </div>
                            <div class='form-group'>
                            <label >Miligramos </label>
                            <input type='text' class='form-control' name='editMil' id='medMil' value='".$item["miligramos"]."' data-field='editMil'>
                           <div id='valid-med2'></div>
                            <div class='valid-message'></div>
                            </div>
                          <div class='form-group'>
                          <label >Descripción </label>
                          <input type='text' class='form-control' name='editDes' id='medDes' value='".$item["descripcion"]."' data-field='editDes' >
                          <div class='valid-message'></div>
                          </div>
                          <div class='form-group'>
                          <input type='submit' name='editarMed' id='editarMed' class='btn btn-primary' value='Editar'>
                          </div>

                          </form>

                            </div>
                            
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                      
                   
                    </tr>
                    
                    
                    ";
                    
                }
      }
      
       
                
          
       
    }
    public function listarMedicamentosRecetaController(){
      if(isset($_SESSION["id_medico"])){
        $id = $_SESSION["id_medico"];
        $respuesta =Medico::listarMedicamentosReceta($id);
        foreach($respuesta as $row => $item){
            echo "
            <option value='".$item['nombreMedicamento']."'>".$item['nombreMedicamento'].'('.$item['miligramos']."mg)</option>";

                }
      }
      
       
    }
    public function borrarMedicamentoController(){

        if(isset($_POST["borrarMedB"])){

            $datosController = $_POST["borrarMed"];
            $respuesta = new Medico();
            
 
           $respuesta->borrarMedicamento($datosController);

  
 
             
             
        }
    }
    public function actualizarMedicamentosController(){

        if( isset($_POST["editarMed"]) && isset($_POST["idEditarMed"])){

            $id = $_POST["idEditarMed"];
            $datosController = array("nombre"=>$_POST["editNombreMed"],"miligramos"=>$_POST["editMil"],"descripcion" =>$_POST["editDes"]);

            
 $respuesta = new Medico();
  $respuesta->actualizarMedicamento($id,$datosController);

 
 
             
             
        }
    }

    public function loginController(){
        if(isset($_POST["entrarLog"])){
            $encriptar =crypt($_POST["passIngreso"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $datosController = array("correo"=>$_POST["correoIngreso"],"password"=>$encriptar);
            $respuesta = Usuario::login($datosController);
                if($respuesta["correoUsuario"]== $_POST["correoIngreso"] && $respuesta["passwordUsuario"] == $encriptar && $respuesta["tipoUsuario"] == 1){
                    session_start();
                    $_SESSION["admin"] = true;
                    $_SESSION["id_admin"] = $respuesta["id_usuario"];
                    $_SESSION["rutAdmin"] = $respuesta["rutUsuario"];
                    $_SESSION["nombreAdmin"] = $respuesta["nombreUsuario"];
                    $_SESSION["apellidoAdmin"] = $respuesta["apellidoUsuario"];
                    $_SESSION["telefonoAdmin"] = $respuesta["telefonoUsuario"];
                    $_SESSION["correoAdmin"] = $respuesta["correoUsuario"];
                    $_SESSION["contraseñaAdmin"] = $respuesta["passwordUsuario"];

                    header("location:Vista/modulos/admin/inicio.php");
    
                }else  if($respuesta["correoUsuario"] == $_POST["correoIngreso"] && $respuesta["passwordUsuario"] == $encriptar && $respuesta["tipoUsuario"] == 2 && $respuesta["especialidad"] != null){
                    session_start();
                    $_SESSION["medico"] = true;
                    $_SESSION["id_medico"] = $respuesta["id_usuario"];
                    $_SESSION["rutMedico"] = $respuesta["rutUsuario"];
                    $_SESSION["nombreMedico"] = $respuesta["nombreUsuario"];
                    $_SESSION["apellidoMedico"] = $respuesta["apellidoUsuario"];
                    $_SESSION["telefonoMedico"] = $respuesta["telefonoUsuario"];
                    $_SESSION["correoMedico"] = $respuesta["correoUsuario"];
                    $_SESSION["contraseñaMedico"] = $respuesta["passwordUsuario"];
                    $_SESSION["empresa"] = $respuesta["empresa"];

                    header("location:Vista/modulos/medico/inicio.php");
    
                  }else  if($respuesta["correoUsuario"] == $_POST["correoIngreso"] && $respuesta["passwordUsuario"] == $encriptar && $respuesta["tipoUsuario"] == 3 && $respuesta["empresa"] != null){
                    session_start();
                    $_SESSION["secretario"] = true;
                    $_SESSION["id_secretario"] = $respuesta["id_usuario"];
                    $_SESSION["rutSecretario"] = $respuesta["rutUsuario"];
                    $_SESSION["nombreSecretario"] = $respuesta["nombreUsuario"];
                    $_SESSION["apellidoSecretario"] = $respuesta["apellidoUsuario"];
                    $_SESSION["telefonoSecretario"] = $respuesta["telefonoUsuario"];
                    $_SESSION["correoSecretario"] = $respuesta["correoUsuario"];
                    $_SESSION["contraseñaSecretario"] = $respuesta["passwordUsuario"];
                    $_SESSION["empresa"] = $respuesta["empresa"];
                    $_SESSION["medico"] = $respuesta["medico"];

                    header("location:Vista/modulos/secretario/inicio.php");
    
                }else{
                  echo"<div class='alert alert-danger'> Credenciales incorrectas</div>";

                }
                
            

        

           
        }
    }
    public function logoutController(){
      $respuesta = new Usuario();
      $respuesta->logout();
    }
    public function registrarPacienteController(){


        if(isset($_POST["pacienteRegistro"]) && isset($_SESSION["id_secretario"]) && isset($_SESSION["medico"]) && isset($_SESSION["empresa"])){
                

               if(isset($_POST["genero"]) && $_POST["genero"] == 1){
                $datosController = array("rut"=>$_POST["rutPaciente"],"nombre"=>$_POST["nombrePaciente"],"apellido" =>$_POST["apellidoPaciente"],"fechaNac" =>$_POST["fechaNacPaciente"],"genero" => "Masculino", "telefono"=>$_POST["telefonoPaciente"],"correo"=>$_POST["emailPaciente"],"direccion"=>$_POST["direccionPaciente"], "secretario"=>$_SESSION["id_secretario"], "medico"=>$_SESSION["medico"],"empresa"=>$_SESSION["empresa"]);
                $respuesta = new Secretario();
                $respuesta->registrarPaciente($datosController);
               }
               if(isset($_POST["genero"]) && $_POST["genero"] == 2){
                $datosController = array("rut"=>$_POST["rutPaciente"],"nombre"=>$_POST["nombrePaciente"],"apellido" =>$_POST["apellidoPaciente"],"fechaNac" =>$_POST["fechaNacPaciente"],"genero" => "Femenino", "telefono"=>$_POST["telefonoPaciente"],"correo"=>$_POST["emailPaciente"],"direccion"=>$_POST["direccionPaciente"], "secretario"=>$_SESSION["id_secretario"], "medico"=>$_SESSION["medico"],"empresa"=>$_SESSION["empresa"]);
                $respuesta2 = new Secretario();
                $respuesta2->registrarPaciente($datosController);
              }
                    
                          
                    
                   
                    
          }
    }
    public function listarPacientesController(){
      if(isset($_SESSION["id_secretario"]) && isset($_SESSION["medico"])){
        $respuesta =Secretario::listarPacientes($_SESSION["medico"]);
        foreach($respuesta as $row => $item){
            echo "<tr>
                        <td>".$item["rutPaciente"]."</td>
                        <td>".$item["nombrePaciente"]."</td>
                        <td>".$item["apellidoPaciente"]."</td>
                        <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrar".str_replace(' ','',$item["rutPaciente"])."'>
                        Borrar
                      </button>                      
                       <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_paciente"])."'>
                      Editar
                    </button>  </td>
                      <div class='modal fade' id='borrar".str_replace(' ','',$item["rutPaciente"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                      <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title'>Borrar Paciente</h5>
                          </div>
                          <div class='modal-body'>
                          <p> ¿Deseas eliminar el siguiente paciente: ".$item["rutPaciente"]."?</p>
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                              <form method='POST'>
                              <input type='hidden' name='borrarPaciente' value='".$item["id_paciente"]."'
                              <div class='form-group'>
                              <input type='submit' name='borrarPacienteB' class='btn btn-danger' value='Borrar'>
                              </div>
                              </form>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class='modal fade' id='edit".str_replace(' ','',$item["id_paciente"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title'>Editar Paciente</h5>
                        </div>
                        <div class='modal-body'>
                            <div class='container'>
                            <div class='row'>
                            <div class='col'>
                            <form method='POST'>
                            <input type='hidden' class='form-control' name='idEditarPaciente' value='".$item["id_paciente"]."' >
                            <div class='form-group'>
                            <label >RUT </label>
                            <input type='text' class='form-control' name='' value='".$item["rutPaciente"]."' disabled>
                            </div>
                            <div class='form-group'>
                              <label >Nombre </label>
                              <input type='text' class='form-control' name='' value='".$item["nombrePaciente"]."'disabled >
                            </div>
                            <div class='form-group'>
                            <label >Apellido </label>
                            <input type='text' class='form-control' name='' value='".$item["apellidoPaciente"]."' disabled>
                          </div>
                          <div class='form-group'>
                          <label >Fecha de nacimiento </label>
                          <input type='text' class='form-control' name='' value='".$item["fechaNac"]."' disabled>
                          </div>
                          <div class='form-group'>
                          <label >Género </label>
                          <input type='text' class='form-control' name='' value='".$item["genero"]."' disabled>
                          </div>
                          <div class='form-group'>
                          <label >Telefono </label>
                          <input type='text' class='form-control' name='editTelPaciente' value='".$item["telefonoPaciente"]."' >
                          </div>
                          <div class='form-group'>
                          <label >Correo </label>
                          <input type='text' class='form-control' name='editCorreoPaciente' value='".$item["correoPaciente"]."' >
                          </div>
                          <div class='form-group'>

                          <label >Dirección </label>
                          <input type='text' class='form-control' name='editDir' value='".$item["direccionPaciente"]."' >
                          </div>
                          <div class='form-group'>
                          <input type='submit' name='editarPaciente' class='btn btn-primary' value='Editar'>
                          </div>

                          </form>

                            </div>
                            
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                        

                        
                    </tr>
                    
           
                    
                    
                    
                    "
                    
                    
                    
                    ;
                }

              }

       
    }
    public function listarPacientesMedicoController(){
      if(isset($_SESSION["id_medico"])){
        $id =  $_SESSION["id_medico"];
        $respuesta =Medico::listarPacientesMedico($id);
        foreach($respuesta as $row => $item){
            echo "<tr>
                        <td>".$item["rutPaciente"]."</td>
                        <td>".$item["nombrePaciente"]."</td>
                        <td>".$item["apellidoPaciente"]."</td>
                        <td><a  href='ficha.php?action=&idFicha=".base64url_encode($item["id_paciente"]."".$item["nombrePaciente"]."".$item["apellidoPaciente"])."'><button class='btm btn-primary'  >Ficha</button></a></td>

                    </tr>";
                }
      }
     
    }
    public function actualizarPacienteController(){

        if( isset($_POST["editarPaciente"])){

            $id = $_POST["idEditarPaciente"];
            $datosController = array("telefono"=>$_POST["editTelPaciente"],"correo"=>$_POST["editCorreoPaciente"],"direccion"=>$_POST["editDir"]);

            
 $respuesta = new Secretario();
  $respuesta->actualizarPaciente($id,$datosController);

 
 
             
             
        }
    }
    public function borrarPacienteController(){
        if(isset($_POST["borrarPacienteB"])){
            $datosController = $_POST["borrarPaciente"];
            $respuesta = new Secretario();
            $respuesta->borrarPaciente($datosController);            
        }
    }
    public function verPacienteController(){
        if(isset($_GET["idFicha"])){
            $datosController = base64url_decode($_GET["idFicha"]);
            $respuesta =Medico::verPaciente($datosController);
            foreach($respuesta as $row => $item){
                echo "
                <div class='container'>
                <div class='row'>
                <div class='col'>
                <form>
                <div class='form-group'>
                  <label >RUT</label>
                  <input type='text' class='form-control' id='formGroupExampleInput' value='".$item["rutPaciente"]."' disabled> 
               </div>
                <div class='form-group'>
                  <label >Nombre </label>
                  <input type='text' class='form-control' value='".$item["nombrePaciente"]."' disabled>
                </div>
                <div class='form-group'>
                <label >Apellido </label>
                <input type='text' class='form-control' value='".$item["apellidoPaciente"]."' disabled>
              </div>
              <div class='form-group'>
              <label >Fecha de nacimiento </label>
              <input type='text' class='form-control' value='".$item["fechaNac"]."' disabled>
              </div>
              </form>'
                </div>
                <div class='col'>
                <form>
                <div class='form-group'>
                  <label >Correo</label>
                  <input type='text' class='form-control' id='formGroupExampleInput' value='".$item["correoPaciente"]."' disabled> 
               </div>
                <div class='form-group'>
                  <label >Dirección </label>
                  <input type='text' class='form-control' value='".$item["direccionPaciente"]."' disabled>
                </div>
                <div class='form-group'>
                <label >Telefono </label>
                <input type='text' class='form-control' value='".$item["telefonoPaciente"]." 'disabled>
              </div>
           
              </form>'
                </div>
                </div>
                </div>"
             ;
                    }
        }
    }
    public function crearConsultaController(){


        if(isset($_POST["consultaRegistro"]) && isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){
                
        
                    $datosController = array("motivo"=>$_POST["motivoConsulta"],"diagnostico"=>$_POST["diagnostico"], "medico"=>$_SESSION["id_medico"]);
                        $id = base64url_decode($_GET["idFicha"]);
                    $respuesta = new Medico();
                        $respuesta->crearConsulta($id,$datosController);
    
                    
          }
    }
    public function verConsultasPacienteController(){
        if(isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){
            $id = base64url_decode($_GET["idFicha"]);
            $medico = $_SESSION["id_medico"];
            $respuesta =Medico::verConsultasPaciente($id, $medico);
            if(count($respuesta) > 0){

                foreach($respuesta as $row => $item){
                 echo "<tr>
                 <td>".$item["fechaR"]."</td>
                 <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrar".str_replace(' ','',$item["id_consulta"])."'>
                 Borrar
               </button>                      
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_consulta"])."'>
               Ver
             </button>  </td>
               <div class='modal fade' id='borrar".str_replace(' ','',$item["id_consulta"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
               <div class='modal-dialog' role='document'>
                 <div class='modal-content'>
                   <div class='modal-header'>
                     <h5 class='modal-title'>Borrar consulta</h5>
                   </div>
                   <div class='modal-body'>
                   <p> ¿Deseas eliminar la consulta registrada el: ".$item["fechaR"]."?</p>
                   </div>
                   <div class='modal-footer'>
                     <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                       <form method='POST'>
                       <input type='hidden' name='borrarConsulta' value='".$item["id_consulta"]."'
                       <div class='form-group'>
                       <input type='submit' name='borrarConsultaB' class='btn btn-danger' value='Borrar'>
                       </div>
                       </form>
                     </div>
                 </div>
               </div>
             </div>
             <div class='modal fade' id='edit".str_replace(' ','',$item["id_consulta"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
             <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                 <div class='modal-header'>
                   <h5 class='modal-title'>Detalle consulta</h5>
                 </div>
                 <div class='modal-body'>
                     <div class='container'>
                     <div class='row'>
                     <div class='col'>
                     <form method='POST'>
                     <input type='hidden' class='form-control' name='idEditarConsulta' value='".$item["id_consulta"]."'disabled >
                     <div class='form-group'>
                        <label >Motivo consulta</label>
                        <input type='text' class='form-control' name='editMotivoConsulta' value='".$item["motivoConsulta"]."' disabled> 
                    </div>
                    <div class='form-group'>
                        <label >Diagnostico</label>
                        <input type='text' class='form-control' name='editDiagnostico' value='".$item["diagnostico"]."' disabled> 
                    </div>
                    <div class='form-group'>
                    <input type='submit' name='editarConsulta' class='btn btn-primary' value='Editar'>
                    </div>
                   </form>

                     </div>
                     </div>
                     </div>

                 </div>
                 <div class='modal-footer'>
                   <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                 </div>
               </div>
             </div>
           </div>
                 

                 
             </tr>             
             
             ";
                 }
               }else{
                 echo"<div class='alert alert-danger'> No existen registros</div>";
               }
        }
    }

    public function borrarConsultaController(){
      if(isset($_POST["borrarConsultaB"])){

        $datosController = $_POST["borrarConsulta"];
        $respuesta = new Medico();
        

$respuesta->borrarConsulta($datosController);



         
         
    }
    }


    public function verConsultasPacienteSecretarioController(){
        if(isset($_GET["idFicha"])){
            $datosController = $_GET["idFicha"];
            $respuesta = new Secretario();
            $respuesta->verConsultasPaciente($datosController);            
        }
    }
    public function signosRegistroController(){


        if(isset($_POST["signosRegistro"]) && isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){
                
            $peso = $_POST["peso"];

            $imc = ($peso/($_POST["altura"]*$_POST["altura"]))*10000;

            $resultado = floor(($imc*100))/100;

                    $datosController = array("presion"=>$_POST["preArterial"],"pulso"=>$_POST["pulso"],"peso"=>$_POST["peso"],"altura"=>$_POST['altura'],"imc"=>$resultado, "medico"=>$_SESSION["id_medico"]);
                        $id = base64url_decode($_GET["idFicha"]);
                        $respuesta = Medico::registrarSignos($id,$datosController);
    
                    
          }
    }
    public function listarSignosController(){
        if(isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){
            $id =base64url_decode($_GET["idFicha"]);
            $medico = $_SESSION["id_medico"];
            $respuesta =Medico::verSignosPaciente($id, $medico);
            if(count($respuesta) > 0){

                foreach($respuesta as $row => $item){
                 echo "<tr>
                 <td>".$item["fechaR"]."</td>
                 <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrar".str_replace(' ','',$item["id_signo"])."'>
                 Borrar
               </button>                      
                <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#edit".str_replace(' ','',$item["id_signo"])."'>
               Ver
             </button>  </td>
               <div class='modal fade' id='borrar".str_replace(' ','',$item["id_signo"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
               <div class='modal-dialog' role='document'>
                 <div class='modal-content'>
                   <div class='modal-header'>
                     <h5 class='modal-title'>Borrar registro</h5>
                   </div>
                   <div class='modal-body'>
                   <p> ¿Deseas eliminar el control de signos vitales registrada el: ".$item["fechaR"]."?</p>
                   </div>
                   <div class='modal-footer'>
                     <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                       <form method='POST'>
                       <input type='hidden' name='borrarSigno' value='".$item["id_signo"]."'
                       <div class='form-group'>
                       <input type='submit' name='borrarSignosB' class='btn btn-danger' value='Borrar'>
                       </div>
                       </form>
                     </div>
                 </div>
               </div>
             </div>
             <div class='modal fade' id='edit".str_replace(' ','',$item["id_signo"])."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
             <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                 <div class='modal-header'>
                   <h5 class='modal-title'>Detalle Signos vitales</h5>
                 </div>
                 <div class='modal-body'>
                     <div class='container'>
                     <div class='row'>
                     <div class='col'>
                     <form method='POST'>
                     <input type='hidden' class='form-control' name='' value='".$item["id_signo"]."'disabled >
                     <div class='form-group'>
                        <label >Presion arterial</label>
                        <input type='text' class='form-control' name='' value='".$item["preArterial"]."' disabled> 
                    </div>
                    <div class='form-group'>
                        <label >Pulso</label>
                        <input type='text' class='form-control' name='' value='".$item["pulso"]."' disabled> 
                    </div>
                    <div class='form-group'>
                    <label >Peso</label>
                    <input type='text' class='form-control' name='' value='".$item["peso"]."' disabled> 
                   </div>
                   <div class='form-group'>
                   <label >Altura</label>
                   <input type='text' class='form-control' name='' value='".$item["altura"]."' disabled> 
                    </div>
                    <div class='form-group'>
                    <label >IMC</label>
                    <input type='text' class='form-control' name='' value='".$item["imc"]."' disabled> 
                    </div>
                   
                   </form>

                     </div>
                     </div>
                     </div>

                 </div>
                 <div class='modal-footer'>
                   <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                 </div>
               </div>
             </div>
           </div>
                 

                 
             </tr>             
             
             ";
                 }
               }else{
                 echo"<div class='alert alert-danger'> No existen registros</div>";
               }                  
        }
    }
    public function borrarSignosController(){
      if(isset($_POST["borrarSignosB"])){

        $datosController = $_POST["borrarSigno"];
        $respuesta = new Medico();
        

$respuesta->borrarSignos($datosController);

         
         
      }
    }
    public function recetaRegistroController(){
      
        if(isset($_POST["recetaRegistro"]) && isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){

                    if(isset($_POST['medReceta'])){
                      $datosController = array("medicamentos"=>implode(',',$medReceta),"indicaciones"=>$_POST["indicaciones"], "medico"=>$_SESSION["id_medico"]);

                    }else{
                      $medReceta = "";

                      $datosController = array("medicamentos"=>$medReceta,"indicaciones"=>$_POST["indicaciones"], "medico"=>$_SESSION["id_medico"]);

                    }
                        $id = base64url_decode($_GET["idFicha"]);
                    $respuesta = new Medico();
                        $respuesta->registrarReceta($id,$datosController);
    
                    
          }
    }
    public function borrarRecetaController(){
      if(isset($_POST["borrarRecetaB"])){

        $datosController = $_POST["borrarReceta"];
        $respuesta = new Medico();
        

$respuesta->borrarReceta($datosController);



         
         
    }
    }
    

    public function verRecetasPacienteController(){
        if(isset($_GET["idFicha"]) && isset($_SESSION["id_medico"])){
            $id = base64url_decode( $_GET["idFicha"]);
            $medico = $_SESSION["id_medico"];
            $respuesta = Medico::verRecetaPaciente($id, $medico);  
            if(count($respuesta) > 0){

              foreach($respuesta as $row => $item){
               echo "<tr>
               <td>".$item["fechaR"]."</td>
               <td> <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#borrarR".$item["id_receta"]."'>
               Borrar
             </button>                      
              <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editR".$item["id_receta"]."'>
             Ver 
           </button>  </td>
             <div class='modal fade' id='borrarR".$item["id_receta"]."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
             <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                 <div class='modal-header'>
                   <h5 class='modal-title'>Modal title</h5>
                 </div>
                 <div class='modal-body'>
                 <p> ¿Deseas eliminar la receta registrada el: ".$item["fechaR"]."?</p>
                 </div>
                 <div class='modal-footer'>
                   <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                     <form method='POST'>
                     <input type='hidden' name='borrarReceta' value='".$item["id_receta"]."'
                     <div class='form-group'>
                     <input type='submit' name='borrarRecetaB' class='btn btn-danger' value='Borrar'>
                     </div>
                     </form>
                   </div>
               </div>
             </div>
           </div>
           <div class='modal fade' id='editR".$item["id_receta"]."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
           <div class='modal-dialog' role='document'>
             <div class='modal-content'>
               <div class='modal-header'>
                 <h5 class='modal-title'>Detalle Receta</h5>
               </div>
               <div class='modal-body'>
                   <div class='container'>
                   <div class='row'>
                   <div class='col'>
                   <form method='POST'>
                   <input type='hidden' class='form-control' name='idEditarReceta' value='".$item["id_receta"]."' disabled >
                   <div class='form-group'>
                      <label >Medicamentos</label>
                      <input type='text' class='form-control' name='editMedicamentos' value='".$item["medicamentos"] ."' disabled> 
                  </div>
                  <div class='form-group'>
                      <label >Indicaciones</label>
                      <textarea id='my-textarea' class='form-control ckeditor' name='editIndicaciones' rows='2' data-field='indicaciones' disabled>".$item["indicaciones"]."</textarea>
                      </div>
                 
                 </form>

                   </div>
                   </div>
                  

               </div>
               <div class='modal-footer'>
                 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
               </div>
             </div>
           </div>
         </div>
               

               
           </tr>             
           
           ";
               }
             }else{
               echo"<div class='alert alert-danger'> No existen registros</div>";
             }          
        }
    }
      
}

function base64url_encode($data)
{
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

function base64url_decode($data, $strict = false)
{
  // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
  $b64 = strtr($data, '-_', '+/');

  // Decode Base64 string and return the original data
  return base64_decode($b64, $strict);
}