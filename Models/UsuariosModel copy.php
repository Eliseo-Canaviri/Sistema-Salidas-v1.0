<?php
class UsuariosModel extends Query{
   private $nombres, $apellidos, $email, $clave,$id_usuario,$estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $email, string $clave ,int $estado)
    {
        $sql = "SELECT * FROM usuarios WHERE email='$email' AND clave='$clave' AND estado=$estado ";
        $data = $this->select($sql);
        return $data;
    }


public function getUsuarios( $estado){
    $sql="SELECT * FROM usuarios WHERE estado= $estado";
    $data= $this->selectAll($sql);
        return $data;
}

public function registrarUsuario(string $nombres, string $apellidos, string $email, string $clave)
{
    $this->nombres=$nombres;
    $this->apellidos=$apellidos;
     $this->email=$email;
       $this->clave=$clave;
       //para verificar si existe usuario
       $verificar="SELECT *FROM usuarios WHERE email='$this->email'";
       $existe=$this->select($verificar);
       if (empty($existe)) {
           $sql= "INSERT INTO usuarios(nombres,apellidos, email, clave) VALUES (?,?,?,?)";
       $datos=array($this->nombres, $this->apellidos, $this->email, $this->clave);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
       $data=$this->save($sql,$datos);
       if ($data==1) {
           $res ="ok";
       }else{
        $res ="error";
       }  
       }else{
        $res="existe";
       }

     
       return $res ; 
       //este meotodo vamos llamar desde nuestro controlador usuario

}
public function modificarUsuario(string $nombres,string $apellidos, string $email, int $id_usuario)
{
    $this->nombres=$nombres;
    $this->apellidos=$apellidos;
     $this->email=$email;
       $this->id_usuario=$id_usuario;
       //para verificar si existe usuario
         $sql= "UPDATE  usuarios SET nombres=?, apellidos=?, email=? WHERE id_usuario=?";
       $datos=array($this->nombres, $this->apellidos, $this->email, $this->id_usuario);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
       $data=$this->save($sql,$datos);
       if ($data==1) {
           $res ="modificado";
       }else{
        $res ="error";
       } 
       return $res ; 
       //este meotodo vamos llamar desde nuestro controlador usuario

}

public function editarUser(int $id)
{//este metodo vamos llamar de controlador
  $sql= "SELECT * FROM usuarios WHERE id_usuario= $id";
 $data= $this->select($sql);

 return $data;
}
public function getPass(string $clave, int $id)
{//este metodo vamos llamar de controlador
  $sql= "SELECT * FROM usuarios WHERE clave= '$clave' AND id_usuario= $id";
 $data= $this->select($sql);

 return $data;
}

public function accionUser(int $estado ,int $id )
{
    // code...
    $this->id_usuario=$id;
    $this->estado=$estado;
    $sql="UPDATE usuarios SET estado= ? WHERE id_usuario=?";
    $datos=array($this->estado, $this->id_usuario);
    $data=$this->save($sql,$datos);
    return $data;
}

public function modificarPass(string $clave, int $id_usuario)
{
  
    $sql="UPDATE usuarios SET clave= ? WHERE id_usuario=?";
    $datos=array($clave, $id_usuario);
    $data=$this->save($sql,$datos);
    return $data;
    // code...
}

    public function modificarDatoUsuario( string $nombres, string $apellidos, string $email, int $id_usuario)
    {
        $sql = "UPDATE usuarios SET  nombres=?, apellidos=?, email=? WHERE id_usuario=?";
        $datos = array( $nombres, $apellidos, $email, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 1;
        } else {
            $res = 0;
        }
        return $res;
    }





    
}
?>