<?php
class Cliente {
    private $nombre;
    private $email;
    private $contraseña;
    private $tipo;
    public function inicializarCliente($nombre,$contraseña,$email,$tipo) {
        $this->email = $email;
        $this->contraseña = $contraseña;
        $this->nombre=$nombre;
        $this->tipo=$tipo;
    }
    public function inicializarSesion($email, $contraseña) {
        $this->email = $email;
        $this->contraseña = $contraseña;
    }
   

    public function conectarBD() {
        $con = mysqli_connect("localhost", "root", "", "agrimex") or die("Problemas con la base de datos");
        return $con;
    }

    public function cerrarBD($con) {
        mysqli_close($con);
    }

    public function validarIngreso() {
        $conexion = $this->conectarBD();
        $query = "SELECT * FROM cliente WHERE email = '$this->email' AND contrasena = '$this->contraseña'";
        $registros = mysqli_query($conexion, $query) or die(mysqli_error($conexion));
        $filas = mysqli_num_rows($registros);

        if ($filas == 1) {
           if ($reg = mysqli_fetch_array($registros)) {
                if ($reg['tipo']=='administrador') {        
                header("location: ../html/perfil_admin.html");
                
                }if ($reg['tipo']=='cliente'){

                header("location: ../html/perfil_cliente.html");
                }if ($reg['tipo']=='agricultor'){

                header("location: ../html/perfil_agricultor.html");
                }
           }
        }else {      
                
            echo '
            <script>
                alert("Usuario o contraseña incorrectos");
                window.location = "../inicio_sesion.html";
            </script>
                ';
        exit;
        
        }

        $this->cerrarBD($conexion);
    }
    public function registrarCliente(){
        $conexion = $this->conectarBD();
        $verif = mysqli_query($conexion, "SELECT * FROM cliente WHERE email='$this->email' ");

    if(mysqli_num_rows($verif) > 0){
        echo '
         <script>
            alert("Este correo ya esta registrado, intenta con otro diferente");
            window.location = "../index.html";
         </script>
        ';
        exit();
    }
        $query = "INSERT INTO cliente (nombre,email,contrasena,tipo) 
        VALUES('$this->nombre','$this->email','$this->contraseña','$this->tipo')";
        print $this->nombre.$this->email;
        $resul = mysqli_query($conexion,$query);

        if($resul){
            echo '
                <script>
                    alert("Usuario Registrado exitosamente");
                    
                </script>
            ';
            // hay que agregar el redireccionamiento pero aun no tenemos la pagina jaja 
            // window.location = "../index.html"
        }else{
            echo '
            <script>
                alert(":( Registro incorrecto");
            </script>
        ';
        }
        $this->cerrarBD($conexion);
    }
}
