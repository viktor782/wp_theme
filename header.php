<!DOCTYPE html>
<html>
<head>
    <title><?php wp_title('', true); ?></title>
    <?php wp_head(); ?>
    <link rel="shortcut icon" href="<?php bloginfo("template_url"); ?>/favico.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body <?php body_class(); ?>>
<header id="header">
    <div id="header-top">
        <div class="container">
            <div class="center">

                <div class="header_top_bg">
                    <?php dynamic_sidebar('widget-header-left-top') ?>
                    <?php get_search_form() ?>
                    <div class="widget widget-header-right-top">
                        <div class="wp-block-code">
                            <?php pll_the_languages([
                                'show_names' => false,
                                'display_names_as' => 'slug',
                                'show_flags' => true,
                                'force_home' => false,
                            ]); ?>

                        </div>
                    </div>
                    <?php dynamic_sidebar('widget-header-right-top') ?>
                    <a href="#" class="mobile-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <!--begin гамбергер меню -->
                <div class="menu-fixed" style="display: none">
                    <a href="javascript:;" class="menu-close-area close-first-level"></a>
                    <div class="first-level" style="display: none;">
                        <div class="fixed-menu-header">

                            <span class="MENUICON"></span>
                            <div class="search_mob">

                            </div>

                            <a href="#" class="fixed-menu-close close-first-level"><span></span></a>
                        </div>
                        <div class="first_level__container">
                            <ul class="fixed-menu-list">
                                <li>
                                    <div class="widget widget-header-right-top">
                                        <div class="wp-block-code">
                                            <?php pll_the_languages([
                                                'show_names' => false,
                                                'display_names_as' => 'slug',
                                                'show_flags' => true,
                                                'force_home' => false,
                                            ]); ?>
                                            <?php dynamic_sidebar('widget-header-menu') ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end гамбергер меню -->
            </div>
        </div>
    </div>
    <div id="header-middle">
        <div class="container">
            <div class="center">
                <div class="widget widget-header-middle">
                    <div class="wp-block-image size-large">
                        <img src="/wp-content/uploads/2022/01/panda-1024x335.png" alt="">
                    </div>
                </div>
                <div id="logo">
                    <?php dynamic_sidebar('widget-header-middle') ?>
                </div>
            </div>
        </div>
    </div>
    <div id="header-bottom">
        <div class="center">
            <?php wp_nav_menu([
                'container' => 'nav',
                'theme_location' => 'primary',
                'container_class' => 'container'
            ]); ?>
        </div>
    </div>
    <div class="mobile_strip">
        <div class="center">
            <span class="bacgr"></span>
        </div>
    </div>

</header>