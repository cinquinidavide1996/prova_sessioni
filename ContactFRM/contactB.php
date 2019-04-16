<?php

class Controller {

    function __construct($function) {
        header('Content-Type: application/json');
        unset($_POST['function']);
        $param = '';

        for ($i = 0; $i < count($_POST); $i++) {
            $param .= '$_POST[' . $i . '],';
        }

        $param = substr($param, 0, strlen($param) - 1);

        $ris = eval('return $this->' . $function . "($param);");


        if ($function !== 'getMethod') {
            $this->send($ris);
        }
    }

    function getMethod() {
        $result = [];

        $controllerMethod = get_class_methods('Controller');
        foreach (get_class_methods('functionPHP') as $fMethod) {
            if (!in_array($fMethod, $controllerMethod)) {
                $r = new ReflectionMethod('functionPHP', $fMethod);
                $result[$fMethod] = [];
                foreach ($r->getParameters() as $v) {
                    $result[$fMethod][] = $v->name;
                }
            }
        }
        echo json_encode($result, true);
    }

    protected function send($ris = array(), $type = 'success') {
        echo json_encode([
            'status' => $type,
            'result' => $ris
                ], true);
    }

}
