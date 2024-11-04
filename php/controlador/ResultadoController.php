<?php
require_once "models/Resultado.php";

class ResultadoController {
    public $view;
    public $showLayout = true;
    private $resultado;

    public function __construct($db) {
        $this->resultado = new Resultado($db);
    }

public function buscar() {
    $termino = isset($_GET['termino']) ? $_GET['termino'] : '';
    
    if (empty($termino)) {
        $_SESSION['mensaje'] = "Debe ingresar un término de búsqueda.";
        header("Location: index.php");
        exit();
    }
    
    $temas = $this->resultado->buscarTemas($termino);
    $posts = $this->resultado->buscarPreguntas($termino);

    
    
    $this->view = "resultado";
    return [
        'tema' => $temas,
        'post' => $posts,
        'termino' => $termino,
    ];
}
}