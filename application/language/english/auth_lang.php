<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your email and password below.';
$lang['login_identity_label']  = 'E-mail Address:';
$lang['login_password_label']  = 'Password:';
$lang['login_identity_ph']     = 'E-mail Address';
$lang['login_password_ph']     = 'Password';
$lang['login_remember_label']  = 'Remember Me';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_id_th']             = 'ID';
$lang['index_ava_th']            = 'Avatar';
$lang['index_full_name_th']      = 'Full Name';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_phone_th']          = 'Phone';
$lang['index_major_th']          = 'Major';
$lang['index_role_th']           = 'Role';
$lang['index_created_th']        = 'Created On';
$lang['index_lastlog_th']        = 'Last Login';
$lang['index_email_th']          = 'Email';
$lang['index_uname_th']          = 'NIM/NIP';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_register_heading']                  = 'Register'; 
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_register_subheading']               = 'Please enter your information below.';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fullname_label']                    = 'Full Name:';
$lang['create_user_gender_label']                      = 'Gender:';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'NIM/NIP:';
$lang['create_user_role_label']                        = 'Role:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_secondary_email_label']             = 'Secondary Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_major_label']                       = 'Major:';
$lang['create_user_unit_label']                        = 'Unit:';
$lang['create_user_home_addreess_label']               = 'Home Address:';
$lang['create_user_register_submit_btn']               = 'Register Now';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_close_modal']                       = 'Close';
$lang['create_user_secondary_email_ph']                = 'Optional Email (user@polman-bandung.ac.id)';
$lang['create_user_validation_fullname_label']         = 'Full Name';
$lang['create_user_validation_gender_label']           = 'Gender';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'NIM/NIP';
$lang['create_user_validation_role_label']             = 'Role';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_secondary_email_label']  = 'Secondary Email';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['create_user_validation_major_label']            = 'Major';
$lang['create_user_validation_unit_label']             = 'Unit';
$lang['create_user_validation_home_addreess_label']    = 'Home Address';
$lang['create_user_gender_m_value']                    = 'M';
$lang['create_user_gender_f_value']                    = 'F';
$lang['create_user_gender_m_label']                    = 'Male';
$lang['create_user_gender_f_label']                    = 'Female';

// Edit User
$lang['edit_profile_heading']                        = 'Edit Profile';
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_identity_label']                    = 'NIM/NIP:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_close_modal']                       = 'Close';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';
$lang['edit_user_validation_gender_label']           = 'Gender';
$lang['edit_user_gender_label']                      = 'Gender:';
$lang['edit_user_gender_m_value']                    = 'M';
$lang['edit_user_gender_f_value']                    = 'F';
$lang['edit_user_gender_m_label']                    = 'Male';
$lang['edit_user_gender_f_label']                    = 'Female';
$lang['edit_user_role_label']                        = 'Role:';
$lang['edit_user_secondary_email_label']             = 'Secondary Email:';
$lang['edit_user_major_label']                       = 'Major:';
$lang['edit_user_unit_label']                        = 'Unit:';
$lang['edit_user_home_addreess_label']               = 'Home Address:';
$lang['edit_user_secondary_email_ph']                = 'Optional Email (user@polman-bandung.ac.id)';
$lang['edit_user_validation_role_label']             = 'Role';
$lang['edit_user_validation_secondary_email_label']  = 'Secondary Email';
$lang['edit_user_validation_major_label']            = 'Major';
$lang['edit_user_validation_unit_label']             = 'Unit';
$lang['edit_user_validation_home_addreess_label']    = 'Home Address';
$lang['edit_user_secondary_email_ph']                = 'Optional Email (user@polman-bandung.ac.id)';
$lang['edit_user_ava_heading']                       = 'Change Avatar';
$lang['edit_user_ava_submit_btn']                    = 'Change';

$lang['delete_user_heading']            = 'Delete User';
$lang['delete_user_subheading']         = 'Are you sure to delete this user with following information?';
$lang['delete_user_full_name_label']    = 'Full Name:';
$lang['delete_user_username_label']     = 'NIM/NIP:';
$lang['delete_user_role_label']         = 'Role:';
$lang['delete_user_email_label']        = 'Email:';
$lang['delete_user_close_modal']        = 'No';
$lang['delete_user_submit_btn']         = 'Yes';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password:';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_reset_btn']                             = 'Reset';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your Email Address so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = 'Email Address:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_identity_label']          = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';
$lang['forgot_password_identity_not_found']      = 'No record of that username.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password:';
$lang['reset_password_new_password_ph']                       = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Privileges
$lang['privileges_heading']      = 'Edit User Privileges';
$lang['privileges_create_label'] = 'Create';
$lang['privileges_read_label']   = 'Read';
$lang['privileges_update_label'] = 'Update';
$lang['privileges_delete_label'] = 'Delete';
$lang['privileges_submit_btn']   = 'Save';
$lang['privileges_cancel_btn']   = 'Close';
