<?php

$saldoCajero = readline("ingrese el dinero que tendra el cajero"); 

function validarUsuario() {
    echo "Bienvenido al Daviplata.\n";
    echo "ingrese numero de tarjeta: ";
    $tarjeta = readline();
    echo "Ingrese su contraseña: ";
    $contrasena = readline();

    if ($tarjeta == "1084331602" && $contrasena == "1101") {
        echo "Bienvenido Kerlin\n";
        return true;
    } else {
        echo "Numero de tarjeta o contraseña incorrecto. Intente de nuevo.\n";
        return false;
    }
}

function consultarSaldo($saldo) {
    echo "\nTu saldo actual es: $saldo\n";
}

function Retirar(&$saldo) {
    while (true) {
        echo "\nIntroduce el monto que deseas sacar (10000, 50000, 100000, 150000 o más): ";
        $monto_retiro = readline();

        if ($monto_retiro == 10000 || $monto_retiro == 50000 || $monto_retiro == 100000 || $monto_retiro == 150000 || $monto_retiro > 50000) {
            if ($monto_retiro <= $saldo) {
                $saldo -= $monto_retiro;
                echo "\nRetiro exitoso de $monto_retiro, nuevo saldo: $saldo\n";
            } else {
                echo "\nNo tienes suficiente dinero . Saldo actual: $saldo\n";
            }
        } else {
            echo "\nEl monto ingresado se permite, ingrese 10000, 50000, 100000, 150000 o un monto mayor a 50000.\n";
        }

        echo "\n¿Deseas realizar otro retiro? (si/no): ";
        $continuar = strtolower(readline());

        if ($continuar != 'si') {
            break; 
        }
    }
}

function gestionarDeposito(&$saldo) {
    echo "\nIntroduce el monto que deseas depositar: ";
    $monto_deposito = readline();

    if ($monto_deposito > 0) {
        $saldo += $monto_deposito;
        echo "\nDeposito exitoso de $monto_deposito. Nuevo saldo: $saldo\n";
    } else {
        echo "\nEl monto ingresado no es válido.\n";
    }
}

function cajeroAuto() {
    global $saldoCajero; 
    $saldoUsuario = 0; 

    echo "Saldo inicial del cajero: $saldoCajero\n";

    if (!validarUsuario()) {
        return;
    }

    while (true) {
        echo "\nMenu Principal:\n";
        echo "1. Consultar saldo\n";
        echo "2. Retirar dinero\n";
        echo "3. Depositar dinero\n";
        echo "4. Salir \n";
        echo "Seleccione una opción (1/2/3/4): ";
        $opcion = readline();

        switch ($opcion) {
            case '1':
                consultarSaldo($saldoUsuario);
                break;
            case '2':
                Retirar($saldoUsuario);
                break;
            case '3':
                gestionarDeposito($saldoUsuario);
                break;
            case '4':
                echo "\nGracias por utilizar nuestro servicio Daviplata.\n";
                return;
            default:
                echo "\nOpción incorrecta. Por favor elija 1, 2, 3 o 4.\n";
                break;
        }
    }
}

cajeroAuto();

?>
