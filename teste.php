<?php

// TEXTOS DE TESTE
$testePangramatico1 = "Quero faxina nas locadoras de video: jogue blitz com whisky PM";
$testeFraseOfensiva1 = "This website is for losers LOL!";
$testeMaiorMenor = "1 9 6 4 3 1 -5";
$testeTextoInicial = "Ditoso seja aquele que somente"; $testeTextoFinal = "somenEte";
$testeCaracteresUnicos = "pasta de peixe é ruim";
$testeInterseccaoArray1 = ['a', 'b', 'c', 'd', 'e', 'f']; $testeInterseccaoArray2 = ['e', 'f', 'g', 'h', 'i'];
$testeStringsParaCompactar = "aaaaabcdddeeeeeeaaa";
$testeParentesesASeremBalanceados = ["(())", "(()", "())(", "()()()", "(((()()())))((()))", ")()()()"];

// EXERCICIO 1
function checarPangramatica(string $frasePangramatica) {    
    $alfabeto = "abcdefghijklmnopqrstuvwxyz";
    $fraseFiltradaConvertidaEmMinusculo = strtolower(preg_replace("/[^a-zA-Z]/", "", $frasePangramatica));
    $fraseEmArray = array_unique(str_split($fraseFiltradaConvertidaEmMinusculo));
    sort($fraseEmArray);
    $letrasOrdenadas = implode("", $fraseEmArray);    

    if($alfabeto != $letrasOrdenadas) {
        return false;
    }

    return true;
}

// EXERCICIO 2
function removeVogais(string $fraseOfensiva) {
    return preg_replace("/[aeiouAEIOU]/", "", $fraseOfensiva);
}


// EXERCICIO 3
function maiorMenorNumero(string $numerosSeparadosPorEspaco) {
    $arrayDeNumeros = explode(" ", $numerosSeparadosPorEspaco);
    sort($arrayDeNumeros);

    $menor = $arrayDeNumeros[0];    
    $maior = $arrayDeNumeros[count($arrayDeNumeros) - 1];

    $menorMaior = implode(" ", [$menor, $maior]);

    return $menorMaior;
}

// EXERCICIO 4
function stringQueTerminaComOutra(string $texto, string $fimDoTexto) {
    $textoEmArray = str_split($texto);
    $ultimoCaracterTexto = $textoEmArray[count($textoEmArray) - 1];
    $fimDoTextoEmArray = str_split($fimDoTexto);
    $ultimoCaracterDoFimDoTexto = $fimDoTextoEmArray[count($fimDoTextoEmArray) - 1];

    return str_contains($texto, $fimDoTexto) && $ultimoCaracterTexto == $ultimoCaracterDoFimDoTexto;
}

// EXERCICIO 5
function inverterPalavrasemUmaFrase(string $fraseParaInverter) {
    $palavrasEmArray = explode(" ", $fraseParaInverter);    
    for ($i=0; $i < count($palavrasEmArray); $i++) {
        $palavrasEmArray[$i] = strrev($palavrasEmArray[$i]);
    }

    return implode(" ", $palavrasEmArray);    
}

// EXERCICIO 6 
function contarCaracteresUnicos(string $texto) {
    $textoSemEspacos = preg_replace("/[^a-zA-Z]/", "", $texto);
    $textoEmArray = str_split($textoSemEspacos);
    sort($textoEmArray);
    $swap = "";
    $unicas = [];    
    for ($i=0; $i < count($textoEmArray); $i++) { 
        if ($swap != $textoEmArray[$i]) {
            $swap = $textoEmArray[$i];
            $unicas[] = $textoEmArray[$i];
        } else {
            $unicas = array_filter($unicas, fn($valor) => $valor !== $textoEmArray[$i]);
        }        
    }

    return implode(", ", $unicas);
}

// EXERCICIO 7
function interseccaoDeArrays(array $colecao1, array $colecao2) {
    return array_intersect($colecao1, $colecao2);
}

// EXERCICIO 8 
function compactarStrings(string $texto) {    
    $textoEmArray = str_split($texto);   
    $anterior = "";
    $hash = [];
    $consecutivas = 0;
    for ($i=0; $i < count($textoEmArray); $i++) { 
       if ($textoEmArray[$i] != $anterior) {
            $anterior = $textoEmArray[$i];
            $consecutivas = 1;
            $hash[$i] = $textoEmArray[$i] . $consecutivas;
       } else {
            unset($hash[$i - 1]);
            $consecutivas++;
            $hash[$i] = $textoEmArray[$i] . $consecutivas;
       }
    }

    return implode("", $hash);
}

//9 VALIDAR PARENTESES BALANCEADO
function validarParentesesBalanceado(string $parenteses) {
    $parentesesSeparados = str_split($parenteses);    
    $balanceamento = false;
    $parenteseAberto = "(";
    $parenteseFechado = ")";
    $contarParenteseAberto = 0;
    $contarParenteseFechado = 0;

    if($parentesesSeparados[count($parentesesSeparados) -1] == $parenteseAberto) {
        return $balanceamento;
    }

    if ($parentesesSeparados[0] == $parenteseFechado) {            
        return $balanceamento;
    }
    
    for ($i=0; $i < count($parentesesSeparados); $i++) {        
        
        if ($parentesesSeparados[$i] == $parenteseAberto) {
            $contarParenteseAberto++;
            continue;
        }

        if ($parentesesSeparados[$i] == $parenteseFechado) {
            $contarParenteseFechado++;
            continue;
        }              
    }

    if ($contarParenteseAberto == $contarParenteseFechado) {
        $balanceamento = true;
    }

    return $balanceamento;
}

var_dump(validarParentesesBalanceado("(((()()())))((()))"));

//Saídas
echo "=======================================================\n";
echo "|                    RESULTADOS                       |\n";
echo "=======================================================\n";
echo "\n";
echo "\n";
echo "1 - Teste PanGramático:\n";
echo "Possível frase pangramática: '" . $testePangramatico1 . "'\n";
echo "Resultado:\n";
$ehPangramatico = checarPangramatica($testePangramatico1);
if ($ehPangramatico) {
    echo "*** A frase é pangramática ***";
} else {
     echo "*** A frase não é pangramática ****";
}
echo "\n";
echo "\n";
echo "\n";
echo "2 - Teste Frase Ofensiva:\n";
echo "Frase ofensiva 1: '" . $testeFraseOfensiva1 . "'\n";
echo "Resultado:\n";
var_dump(removeVogais($testeFraseOfensiva1));
echo "\n";
echo "\n";
echo "\n";
echo "3 - Teste maior e menor número separados por espaço:\n";
echo "String com números: '" . $testeMaiorMenor . "'\n";
echo "Resultado:\n";
var_dump(maiorMenorNumero($testeMaiorMenor));
echo "\n";
echo "\n";
echo "\n";
echo "4 - Verificar se uma string termina com outra:\n";
echo "texto inicial: '" . $testeTextoInicial . "', texto final: '" . $testeTextoFinal . "'\n"; 
echo "Resultado:\n";
$temMesmoFinal = stringQueTerminaComOutra($testeTextoInicial, $testeTextoFinal);
if ($temMesmoFinal) {
    echo "*** O texto '". $testeTextoInicial ."' tem o final '". $testeTextoFinal ."' ***";
} else {
     echo "*** O texto '". $testeTextoInicial ."' NÃO tem o final '". $testeTextoFinal ."' ***";
}
echo "\n";
echo "\n";
echo "\n";
echo "5 - Inverter palavras em uma frase:\n";
echo "Frase a ser invertida: '" . $testePangramatico1 . "'\n";
echo "Resultado:\n";
var_dump(inverterPalavrasemUmaFrase($testePangramatico1));
echo "\n";
echo "\n";
echo "\n";
echo "6 - Contar caracteres únicos:\n";
echo "Sentença: '" . $testeCaracteresUnicos . "'\n";
echo "Resultado:\n";
var_dump(contarCaracteresUnicos($testeCaracteresUnicos));
echo "\n";
echo "\n";
echo "\n";
echo "7 - Interseção de arrays:\n";
echo "Arrays de teste: array 1: [" . implode(", ", $testeInterseccaoArray1) . "], array2: [". implode(", ", $testeInterseccaoArray2) .  "]'\n";
echo "Resultado:\n";
print_r(interseccaoDeArrays($testeInterseccaoArray1, $testeInterseccaoArray2));
echo "\n";
echo "\n";
echo "\n";
echo "8 - Compactar string (Run-Length Encoding):\n";
echo "Sequencia de strings a serem compactadas: array 1: '" . $testeStringsParaCompactar .  "'\n";
echo "Resultado:\n";
var_dump(compactarStrings($testeStringsParaCompactar));
echo "\n";
echo "\n";
echo "\n";
echo "9 - Validar parênteses balanceados:\n";
foreach ($testeParentesesASeremBalanceados as $parenteses) {
    echo "Parenteses a serem balanceados: '" . $parenteses .  "'\n";
    echo "Resultado:\n";
    var_dump(validarParentesesBalanceado($parenteses));
    echo "\n";
    echo "\n";
    echo "\n";
}
