<?php
header('Content-type: image/svg+xml');
$color = $_GET["color"];


echo "
<svg xmlns:dc='http://purl.org/dc/elements/1.1/' xmlns:cc='http://creativecommons.org/ns#' xmlns:rdf='http://www.w3.org/1999/02/22-rdf-syntax-ns#' xmlns:svg='http://www.w3.org/2000/svg' xmlns='http://www.w3.org/2000/svg' version='1.1' width='20' height='20' id='svg2'>
<circle cx='10' cy='10' r='5.625' id='c2' style='fill:#$color;stroke:#000000;stroke-width:1.25'/>
</svg>
";
