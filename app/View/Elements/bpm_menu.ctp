<?php
$pastas = $this->requestAction(array('plugin' => null, 'controller' => 'menus', 'action' => 'bpm_menu'));
foreach ($pastas as $nome_pasta)
    echo "<li class='draggable'>" . $this->Html->Link($nome_pasta, array('controller' => 'relatorios', 'action' => 'bpm', $nome_pasta)) . "</li>";
