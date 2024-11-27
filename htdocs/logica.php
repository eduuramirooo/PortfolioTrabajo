<?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            session_start();
            include_once ("conectar.php");
            $conectar = new Conectar("localhost", "root", "", "portfolio");
            $portfolio= $_SESSION['idPortfolio'] ;
            $name = $_POST['name'];
            $apellido = $_POST['apellido'];
            $apellido2 = $_POST['apellido2'];
            $anio = $_POST['anio'];
            $company = $_POST['company'];
            $position = $_POST['position'];
            $fechaE = $_POST['fechaE'];
            $fechaS = $_POST['fechaS'];
            $experience = $_POST['experience'];
            $github = $_POST['github'];
            $twitter = $_POST['twitter'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $queryH = $conectar->hacer_consulta("UPDATE head SET name = ?, apellido = ?, apellido2 = ?, anio = ? WHERE id_portfolio = ?",  "ssssi", [$name, $apellido, $apellido2, $anio, $portfolio]);
            $queryE = $conectar->hacer_consulta("UPDATE linea_experiencia SET company = ?, position = ?, fechaE = ?, fechaS = ?, experience = ? WHERE id_portfolio = ?", "sssssi", [$company, $position, $fechaE, $fechaS, $experience, $portfolio]);
            $querySocial = $conectar->hacer_consulta("UPDATE social SET github = ?, twitter = ?, email = ?, tel = ? WHERE id_portfolio = ?", "ssssi", [$github, $twitter, $email, $tel, $portfolio]);
            if($queryH && $queryE && $querySocial){
                header("Location: index.php?portfolio=".$portfolio."&editar=true");
            }else{
                header("Location: index.php?portfolio=".$portfolio."");
            }
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            session_start();
            include_once ("conectar.php");
            $conectar = new Conectar("localhost", "root", "", "portfolio");
            $portfolio= $_SESSION['idPortfolio'] ;
            $queryE =$conectar-> recibir_datos("Select * from port where id = $portfolio");
            if(!$queryE){
                header("Location: index.php");
            }else{
                $queryA = $queryE[0]['activo'];
                if($queryA == 0){
                    echo $queryE;
                    $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 1 WHERE id = ?", "i", [$portfolio]);
                    echo "<script>document.addEventListener('DOMContentLoaded',()=>{
                        const eliminarP = document.getElementById('eliminarP');
                        eliminarP.innerHTML='Restaurar';
                        eliminarP.href='logica.php?e=0';
                    });</script>";
                    if(!$queryH){
                        header("Location: index.php");
                    }
                }else{
                    $opcion=$_GET['eliminarP']?? null;

                    if($opcion==1){
                        $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 0 WHERE id = ?", "i", [$portfolio]);
                        if(!$queryH){
                            header("Location: index.php");
                        }
                    }else{
                        $queryGA=$conectar->recibir_datos("SELECT * FROM port WHERE id = $portfolio");
                        $estadoG=$queryGA[0]['activo'];
                        if($estadoG == 1){
                            $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 0 WHERE id = ?", "i", [$portfolio]);
                            if(!$queryH){
                                header("Location: index.php");
                           }
                        }else{
                            $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 1 WHERE id = ?", "i", [$portfolio]);
                        if(!$queryH){
                             header("Location: index.php");
                        }
                    }
                }}
            }
            ///valorar el e para cambiar tanto el a como la funcion del sql
            // if($_GET['e'] == 1){
            //     $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 1 WHERE id = ?", "i", [$portfolio]);
            //     echo "<script>document.addEventListener('DOMContentLoaded',()=>{
            //         const eliminarP = document.getElementById('eliminarP');
            //         eliminarP.innerHTML='Restaurar';
            //         eliminarP.href='logica.php?e=0';
            //     });</script>";
            //     if(!$queryH){
            //         header("Location: index.php");
            //     }
            // }else{
            //     $queryH=$conectar -> hacer_consulta("UPDATE port SET activo = 0 WHERE id = ?", "i", [$portfolio]);
            //     echo "<script>document.addEventListener('DOMContentLoaded',()=>{
            //         const eliminarP = document.getElementById('eliminarP');
            //         eliminarP.innerHTML='Eliminar';
            //         eliminarP.href='logica.php?e=1';
            //     });</script>";
            //     if(!$queryH){
            //         header("Location: index.php");
            //     }
            // }
           }

?>