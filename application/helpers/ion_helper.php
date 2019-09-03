<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('user')) {
    /**
     *  return user object (ion_auth)
     *
     *  @param     Integer  $id
     *  @return    Object
     */
    function user($id = null)
    {
        return app('ion_auth')->user($id)->row();
    }
}

if (!function_exists('users')) {
    /**
     *  return users objects (ion_auth)
     *
     *  @param     array  $group_id
     *  @return    Object
     */
    function users($group_id = null)
    {
        return app('ion_auth')->users($group_id)->result();
    }
}

if (!function_exists('group')) {
    /**
     *  return user object (ion_auth)
     *
     *  @param     Integer  $id
     *  @return    Object
     */
    function group($id)
    {
        return app('ion_auth')->group($id);
    }
}

if (!function_exists('groups')) {
    /**
     *  return users objects (ion_auth)
     *
     *  @param     array  $group_id
     *  @return    Object
     */
    function groups()
    {
        return app('ion_auth')->groups()->result();
    }
}

if (!function_exists('users_group')) {
    function users_group($user_id = null)
    {
        return app('ion_auth')->get_users_groups($user_id)->result();
    }
}

if (!function_exists('users_group_one')) {
    function users_group_one($user_id)
    {
        $group_array = app('ion_auth')->get_users_groups($user_id)->result();
        return $group_array[0];
    }
}

if (!function_exists('is_loged_in')) {
    /**
     *  return TRUE if visitor has login
     *
     *  @param     NULL
     *  @return    boolean
     */
    function is_logged_in()
    {
        return app('ion_auth')->logged_in();
    }
}

if (!function_exists('is_loged_out')) {
    /**
     *  return TRUE if visitor has logout
     *
     *  @param     NULL
     *  @return    boolean
     */
    function is_logged_out()
    {
        return !is_logged_in();
    }
}

if (!function_exists('login_required')) {
    /**
     *  REQUIRED for USER ONLY PAGE
     *
     *  @param     NULL
     *  @return    void
     */
    function login_required()
    {
        if (is_logged_out()) { // is anonim
            $prefix = config_item('message_start_prefix');
            $suffix = config_item('message_end_suffix');
            ci()->session->set_flashdata('message', $prefix . "You have to login first" . $suffix);
            redirect(config_item('login_page'), 'refresh');
        } else {
            return true;
        }
    }
}

if (!function_exists('logout_required')) {
    /**
     *  REQUIRED for GUEST ONLY PAGE
     *
     *  @param     NULL
     *  @return    void
     */
    function logout_required()
    {
        if (is_logged_in()) { // is user
            redirect(config_item('login_success_page'), 'refresh');
        } else {
            return true;
        }
    }
}

if (!function_exists('is_user')) {
    /**
     *  if visitor user (loged in) return TRUE
     *
     *  @param     NULL
     *  @return    boolean
     */
    function is_user()
    {
        return is_logged_in();
    }
}

if (!function_exists('is_anonymous')) {
    /**
     *  if visitor anonym (loged out) return TRUE
     *
     *  @param     NULL
     *  @return    boolean
     */
    function is_anonymous()
    {
        return is_logged_out();
    }
}

if (!function_exists('is_admin')) {
    /**
     *  return TRUE if user is admin
     *
     *  @param     NULL
     *  @return    boolean
     */
    function is_admin()
    {
        return app('ion_auth')->is_admin();
    }
}

if (!function_exists('admin_required')) {
    /**
     * user miust be an ADMINISTRATOR to access
     *
     *  @param     NULL
     *  @return    boolean
     */
    function admin_required()
    {
        if (!is_admin()) {
            return show_error('You must be an administrator to view this page.');
        } else {
            return true;
        }
    }
}

if (!function_exists('username_available')) {
    /**
     * TRUEif the user is not registered.
     *
     *  @param     NULL
     *  @return    boolean
     */
    function username_available($username)
    {
        return !app('ion_auth')->username_check($username);
    }
}

if (!function_exists('email_available')) {
    /**
     * TRUEif the user is not registered.
     *
     *  @param     NULL
     *  @return    boolean
     */
    function email_available($email)
    {
        return !app('ion_auth')->email_check($email);
    }
}