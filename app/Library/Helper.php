<?php

function numberToCurrency($n, $n_decimals)
{
    return  (floor($n) == round($n, $n_decimals)) ? number_format($n) : number_format($n, $n_decimals);
}
