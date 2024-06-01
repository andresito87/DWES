<?php
//echo "<PRE>";
//print_r($resultado['content']->data->attributes->last_analysis_results);
//echo "</PRE>";
if (isset($resultado['content']->data->attributes->last_analysis_results))
{
    echo "<TABLE border=1><TR><TH>Motor de antivirus</TH><TH>Resultado</TH><TH>Resultado detallado</TH></TR>";
    foreach ($resultado['content']->data->attributes->last_analysis_results as $result)
    {
        echo "<TR>";
        echo "<TD>{$result->engine_name}</TD>";
        echo "<TD>{$result->category}</TD>";
        echo "<TD>{$result->result}</TD>";
        echo "</TR>";
        
    }
    echo "</TABLE>";
}