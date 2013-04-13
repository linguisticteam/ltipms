<?php
$member_id = $this->session->userdata('member_id');
$member_name = $this->session->userdata('member_name');
?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />  
        <title><?php echo $title; ?> - LTI System Manager</title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/foundation.css" />
        <script src="<?php echo base_url(); ?>js/vendor/custom.modernizr.js"></script>
    </head>

    <body>

<!--        <nav class="top-bar">
            <ul class="title-area">
                 Title Area 
                <li class="name">
                    <h1><a href="/">Home</a></h1>
                </li>
                 Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone 
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">                
            </section>
        </nav>-->
        
        <nav class="top-bar">
            <ul class="title-area">
                <!-- Title Area -->
                <li class="name">
                    <h1><?php echo anchor('', 'Home'); ?></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">
                <ul class="left">                    
                </ul>
                 <!--Right Nav Section-->
                <ul class="right">
                    <li class="divider hide-for-small"></li>
                    <?php
                    if ($member_name!=NULL)
                    {
                    ?>
                    <li class="has-dropdown"><?php echo anchor('members/view/'.$member_id, '('.$member_name.')' ); ?>
                        <ul class="dropdown">
                            <li><?php echo anchor('members/edit_profile/'.$member_id, 'Edit profile' ); ?></li>
                            <li><?php echo anchor('home/do_logout', 'Sign Out'); ?></li>
                        </ul>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li><?php echo anchor('', '('.$member_name.') Sign In'); ?></li>
                    <?php
                    }
                    ?>
                </ul>
            </section>
        </nav>