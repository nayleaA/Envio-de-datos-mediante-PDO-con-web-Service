<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ //comprobar si la peticion es POST si no no hace nada, medida de seguridad
    
    //las variables se van a decodificar en json para enviar y recibir peticiones de valores de variables
    include('database.php');

   // $conn=mysqli_connect($host_name,$host_user,$host_password,$database);
    $conn = new PDO('mysql:host=localhost;dbname=id19597397_practica',$host_user,$host_password);
    

    //$option SI es insercion,actualizacion, consulta ,login... y tenerlo en este mismo documento
    switch($_POST['opcion']){
        case 'login':
            $email=$_POST['email'];
            $password=$_POST['password'];
            
            //se rescatan y se buscan en la BD
            $query="Select * from usuarios where email='$email' and password=MD5('$password')";
            $resultado=$conn->prepare($query);
            $resultado->execute();
          
            $res = $resultado->fetchAll(PDO::FETCH_BOTH);
           // print_r($res);
             
            if(empty($res)){
               $response["Error"]=true;
                $response["mensaje"]="Datos incorrectos";
            }
            else{
                $response["Error"]=false;
                $response["mensaje"]="Datos correctos";
                
                
                
            }
            break;
    }
   //mysqli_close($conn);
    //codificar los datos en json que se enviaran a la app en android
    echo json_encode($response);//lo que imprima como respuesta se manda a voley para interpretarlo mediante JSon
}
?>