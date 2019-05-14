<?php 

class Mazo
{
    private $mazos;

    public function __construct()
    {
        $this->mazos = [];
    }

    public function generar_mazos($cantidad)
    {
        for($i = 0; $i < 4 * $cantidad; $i++){
            for($j = 1; $j <= 13; $j++){
                $this->mazos[] = $j;
            }
        }
        shuffle($this->mazos);
        return $this->mazos;
    }
}

class NanoJack
{
    private $mazos =[];

    public function __construct($mazos)
    {
        $this->mazos = $mazos;
    }
    public function jugar()
    {
        $suma = 0;
        while($suma < 21){
            if((array_sum($this->mazos) + $suma) > 21){
                $suma += array_pop($this->mazos);
            }else{
                $suma += array_sum($this->mazos);
                $this->mazos = [];
                return $suma;
            }
            
        }
        return $suma;
    }
    public function jugar_varios($cantJugadores)
    {
        $resultados = [];
        for($i = 0; $i < $cantJugadores; $i++){
            $resultados[] = $this->jugar();
        }
        return $resultados;
    }
    public function experimentar($rep, $n)
    {
        $listaValores = [];
        for($i = 0; $i < $n; $i++){
            $listaValores[] = 0;
        }
        for($i = 0; $i < $rep; $i++){
            $score = new Score($this->jugar_varios($n));
            $jugada = $score->ver_quien_gano();
            foreach($jugada as $k => $v){
                $listaValores[$k] += $v;
            }
        }
        foreach($listaValores as $k => $v){
            echo 'Jugador ' . ($k + 1) . ' = ' . $v . "\n";
        }
        return $listaValores;
    }
}

class Score
{
    private $resultados;

    public function __construct($resultados)
    {
        $this->resultados = $resultados;
    }

    public function ver_quien_gano()
    {
        $ganadores = [];
        foreach($this->resultados as $value){
            if($value == 21){
                $ganadores[] = 1;
            }else{
                $ganadores[] = 0;
            }
        }
        // foreach($ganadores as $k => $v){
        //     echo 'Jugador ' . $k . ' = ' . $v . "\n";
        // }
        return $ganadores;
    } 
    
}
$m = new Mazo();
$mazos = $m->generar_mazos(20);
$nj = new NanoJack($mazos);
$s = new Score($nj->jugar_varios(4));
//$s->ver_quien_gano();
$s2 = new Score($nj->experimentar(15, 4));
$s2->ver_quien_gano();