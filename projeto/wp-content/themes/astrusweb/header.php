
<!DOCTYPE html>
<html>
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Language" content="pt-br">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="host" content="<?php echo "https://" . $_SERVER['SERVER_NAME']; ?>/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="no-cache">
    <link href="https://fonts.googleapis.com/css?family=Anton|Bebas+Neue|Nobile|PT+Sans|Raleway|Ubuntu:400,500,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/312820fbf8.js" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
    <?php define('SITE', '/'); ?>
    <?php session_start(); ?>
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
</head>
<body>
    <header>
   
<?php 
$cat_da_pagina = get_the_category(); 
$haystack = $_SERVER['REQUEST_URI'];
$needle = "/projetoguilherme/index.php/blog/";
$needle1 = "/projetoguilherme/index.php/category/";


$localhost_string = 'http://localhost'; 
$pag_atual_link = $localhost_string.$haystack; //para dar destaque nas categorias do header!!

if ((strpos($haystack,$needle) !== false) || (strpos($haystack,$needle1) !== false) || is_single()) {
        ?> <section id='header-blog'>

        <div class='header-wrapper-tablet'>
            <div class='header-center'>
                
                <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
                <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
                <div class='header-desc'><img src='<?php echo get_template_directory_uri() ?>/images/blog-header-blog.png'></div>
            </div>
            <div id='burger'>
                <div class='line1'></div>
                <div class='line2'></div>
                <div class='line3'></div>
            </div>
            <ul class='nav-links'>
                <li><a href='http://localhost/projetoguilherme/index.php/belapedra/'>A&nbsp;BELAPEDRA</a></li>
                <li><a href='http://localhost/projetoguilherme/index.php/tecnologia/'>TECNOLOGIA</a></li>
                <li><a href='http://localhost/projetoguilherme/index.php/processos/'>PROCESSOS</a></li>
                <li><a href='http://localhost/projetoguilherme/index.php/produtos/'>PRODUTOS</a></li>
                <li><a href='http://localhost/projetoguilherme/index.php/blog/'>BLOG</a></li>
                <li><a href='http://localhost/projetoguilherme/index.php/contato/'>CONTATO</a></li>
            </ul>
        </div>

        <div class='header-wrapper'>
            <div class='header-lang'>
               
            <div>
            <input type="text" class="s" placeholder="Insira os termos da pesquisa."></div>
                <div class='flags'>
                    <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/brazil.png'></a>
                    <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/united-states.png'></a>
                </div>
            </div>
            <div class='header-main'>
                <div class='header-left'>
                    <div class='header-content <?php if ($pag_atual_link == get_category_link(11)){echo "destacado"; }?>'>
                            <a href='<?php echo get_category_link(11); ?>'>MODA</a>
                    </div>
                    <div class='header-content <?php if ($pag_atual_link == get_category_link(12)){echo "destacado"; }?>'>
                            <a href='<?php echo get_category_link(12) ?>'>JOIAS</a>
                    </div>
                    <div class='header-content <?php if ($pag_atual_link == get_category_link(2)){echo "destacado"; }?>'>
                            <a href='<?php echo get_category_link(2) ?>'>LOOK DO DIA</a>
                    </div>
                </div>
                <div class='header-center'>
                    <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
                    <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
                </div>
                <div class='header-right'>
                    <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/belapedra/'>POR DENTRO DA BELAPEDRA</a></div>
                    <div class='header-content <?php if ($pag_atual_link == "http://localhost/projetoguilherme/index.php/category/diversos/") {echo "destacado"; } ?>'>
                            <a href='<?php echo "http://localhost/projetoguilherme/index.php/category/diversos/"; ?>'>DIVERSOS</button>  
                    </div>
                    <div class='header-content' style='margin-right:0;'><a href='http://localhost/projetoguilherme/index.php'>SITE BELAPEDRA</a></div>
                </div>
            </div>
            <div class='header-bottom'>
                <img src='<?php echo get_template_directory_uri() ?>/images/blog-header-blog.png'>
            </div>
        </div>
    </section>
<?php 
    
} 
    else if (($_SERVER['REQUEST_URI'] == ("/projetoguilherme/")) || ($_SERVER['REQUEST_URI'] == ("/projetoguilherme/index.php/belapedra/"))){
    ?> 
<section id='header'>
    <div class='header-wrapper-tablet'>
        <div class='header-center'>
            <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
            <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
            <div class='header-desc'><p>JEWELRY MANUFACTURER</br>PRIVATE LABEL COLLECTION</p></div>
        </div>
        <div id='burger'>
        <div class='line1'></div>
        <div class='line2'></div>
        <div class='line3'></div>
    </div>
    <ul class='nav-links'>
        <li><a href='http://localhost/projetoguilherme/index.php/belapedra/'>A&nbsp;BELAPEDRA</a></li>
        <li><a href='http://localhost/projetoguilherme/index.php/tecnologia/'>TECNOLOGIA</a></li>
        <li><a href='http://localhost/projetoguilherme/index.php/processos/'>PROCESSOS</a></li>
        <li><a href='http://localhost/projetoguilherme/index.php/produtos/'>PRODUTOS</a></li>
        <li><a href='http://localhost/projetoguilherme/index.php/blog/'>BLOG</a></li>
        <li><a href='http://localhost/projetoguilherme/index.php/contato/'>CONTATO</a></li>
    </ul>
</div>


<div class='header-wrapper'>
    <div class='header-lang'>
        <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/brazil.png'></a>
        <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/united-states.png'></a>
    </div>
    <div class='header-main'>
        <div class='header-left'>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/belapedra/'>A BELAPEDRA</a></div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/tecnologia/'>TECNOLOGIA</a></div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/processos/'>PROCESSOS</a></div>
        </div>
        <div class='header-center'>
            <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
            <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
        </div>
        <div class='header-right'>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/produtos/'>PRODUTOS</a></div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/blog/'>BLOG</a></div>
            <div class='header-content' style='margin-right:0;'><a href='http://localhost/projetoguilherme/index.php/contato/'>CONTATO</a></div>
        </div>
    </div>
    <div class='header-bottom'>
        Jewelry Manufacturer <br> Private Label Collection
    </div>
</div>
</section>
<?php

} else {
    
    ?>

    <section id='header-not-overlap'>


    <div class='header-wrapper-tablet'>
        <div class='header-center'>
            <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
            <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
            <div class='header-desc'><p>JEWELRY MANUFACTURER</br>PRIVATE LABEL COLLECTION</p></div>
        </div>
        <div id='burger'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
        <ul class='nav-links'>
            <li><a href='http://localhost/projetoguilherme/index.php/belapedra/'>A&nbsp;BELAPEDRA</a></li>
            <li><a href='http://localhost/projetoguilherme/index.php/tecnologia/'>TECNOLOGIA</a></li>
            <li><a href='http://localhost/projetoguilherme/index.php/processos/'>PROCESSOS</a></li>
            <li><a href='http://localhost/projetoguilherme/index.php/produtos/'>PRODUTOS</a></li>
            <li><a href='http://localhost/projetoguilherme/index.php/blog/'>BLOG</a></li>
            <li><a href='http://localhost/projetoguilherme/index.php/contato/'>CONTATO</a></li>
        </ul>
    </div>




<div class='header-wrapper'>
    <div class='header-lang'>
        <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/brazil.png'></a>
        <a class='flag-icon'><img src='<?php echo get_template_directory_uri() ?>/images/united-states.png'></a>
    </div>
    <div class='header-main'>
        <div class='header-left'>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/belapedra/'>A BELAPEDRA</a></div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/tecnologia/'>TECNOLOGIA</a></div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/processos/'>PROCESSOS</a></div>
        </div>
        <div class='header-center'>
            <div class='header-logo'><img src='<?php echo get_template_directory_uri() ?>/images/logo.png'></div>
            <div class='header-name'><img src='<?php echo get_template_directory_uri() ?>/images/belapedra-logo.png'></div>
        </div>
        <div class='header-right'>
            <div class='header-content-dropdown'>
                <div><a href='http://localhost/projetoguilherme/index.php/produtos/'>PRODUTOS</a></div>
                <div class='dropdown-hidden'>
                    <form action='http://localhost/projetoguilherme/index.php/produtos/' method='GET'>
                        <input type='hidden' name='produto' value='pedra'>
                        <button class='dropdown-btn' style='padding-right:39px;' type='submit'><i class='fas fa-caret-right'></i><p>PEDRAS</p></button>
                    </form>
                    <form action='http://localhost/projetoguilherme/index.php/produtos/' method='GET'>
                        <input type='hidden' name='produto' value='semijoia'>
                        <button class='dropdown-btn' type='submit'><i class='fas fa-caret-right'></i><p>SEMIJOIAS</p></button>
                    </form>
                </div>
            </div>
            <div class='header-content'><a href='http://localhost/projetoguilherme/index.php/blog/'>BLOG</a></div>
            <div class='header-content' style='margin-right:0;'><a href='http://localhost/projetoguilherme/index.php/contato/'>CONTATO</a></div>
        </div>
    </div>
    <div class='header-bottom'>
        Jewelry Manufacturer <br> Private Label Collection
    </div>
</div>
</section> <?php }
 ?>
 
    </header>