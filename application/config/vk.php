<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['site_name'] = 'eSystem AE';

// controller
$config['login_success_page'] = 'dashboard';
$config['login_page'] = 'auth/login';

// upload ava
$config['avatar_path'] = 'app/avatar/';

// upload gallery
$config['gallery_path'] = 'app/gallery/';
$config['gallery_watermark'] = TRUE;

// assets path
$config['assets_path'] = 'assets/';
$config['css_path'] = 'assets/css/';
$config['js_path'] = 'assets/js/';
$config['fonts_path'] = 'assets/fonts/';
$config['images_path'] = 'assets/images/';

// delimiters
$config['message_start_prefix'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
$config['message_end_suffix'] = '</div>';

// extension
$config['create_user_by_admin_password'] = '1qa2ws3ed';