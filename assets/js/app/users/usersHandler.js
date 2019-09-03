/*
===============================================================
======================LOCAL VARS AND FUNCTION==================
===============================================================
*/

var divSpinner =
    '<div style="height:180px;">' +
    '<div class="spinloader">' +
    '</div>' +
    '</div>';

function switcheryChange(el) {
    if (typeof Event === 'function' || !document.fireEvent) {
        var event = document.createEvent('HTMLEvents');
        event.initEvent('change', true, true);
        el.dispatchEvent(event);
    }
    else {
        el.fireEvent('onchange');
    }
}

// function will execute after ajax call edit form
function afterGetUserModal() {
    $('form.editUserForm').parsley().on('form:submit', function () {
        $.ajax({
            type: 'post',
            url: 'users/ajax_edit/post',
            data: $('form.editUserForm').serialize(),
            cache: false,
            success: function (data) {
                // checking new user data, if exist then reset form, refresh table
                if (data) {
                    $('.modalEditUser').modal('hide');
                    getUsersTable();
                    var PNtitle = 'Updated';
                    var PNtext = 'User has been update successfully';
                    var PNtype = 'success';
                }
                else {
                    var PNtitle = 'Failed';
                    var PNtext = 'Please make sure NIM/NIP and email are unique';
                    var PNtype = 'warning';
                }
                // create new pnotify object
                new PNotify({
                    title: PNtitle,
                    text: PNtext,
                    type: PNtype,
                });
            }
        });
        return false;
    });
}

// function will execute after ajax call table
function afterGetUsersTable() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.changeStatus').on('ifClicked', function (e) {
        var nowChecked = !e.target.checked;
        var id_user = $(this).data('userId');
        var active = nowChecked ? 1 : 0;
        $.ajax({
            type: 'post',
            url: 'users/ajax_activator',
            cache: false,
            data: {
                id_user: id_user,
                active: active
            }
        });
        return false;
    });
}

function afterPrivilegesModal() {
    // initializing
    var jsSwitch = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    jsSwitch.forEach(function (html) {
        var switchery = new Switchery(html, { color: "#26B99A" });
    });
    $('form.editUserPrivileges').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: 'post',
            url: 'users/ajax_privileges/post',
            data: $('form.editUserPrivileges').serialize(),
            cache: false,
            success: function (data) {
                $('.modalPrivileges').modal('hide');
                new PNotify({
                    title: 'Success',
                    text: 'User\'s privileges successfully changed.',
                    type: 'success',
                });
            }
        });
        return false;
    });
}

// function will execute after ajax call open modal delete confirmation
function afterDeleteUsersModal() {
    $('form.deleteUserForm').on('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $.ajax({
            type: 'post',
            url: 'users/ajax_delete/post',
            data: $('form.deleteUserForm').serialize(),
            cache: false,
            success: function (data) {
                $('.modalDeleteUser').modal('hide');
                getUsersTable();
                new PNotify({
                    title: 'Success',
                    text: 'User has been deleted.',
                    type: 'success',
                });
            }
        });
        return false;
    });
}

// REFRESH/GET users table with ajax
function getUsersTable() {
    $.ajax({
        type: 'get',
        url: 'users/ajax_table',
        cache: false,
        beforeSend: function () {
            // loading before get table
            $('.usersTableDiv').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('.usersTableDiv').html(data);
            // reinitializing DataTable
            $('.usersTable').DataTable().draw();
            // initializing icheck
            $('input.changeStatus').iCheck({ checkboxClass: 'icheckbox_flat-green' });
            afterGetUsersTable();
        }
    });
    return false;
}

/*
===============================================================
==============================BIND=============================
===============================================================
*/

// get table when document ready
getUsersTable();

// get table when refresh button clicked
$('button.refreshUsersTable').on('click', function () {
    getUsersTable();
});

// reset modal
$('.modalEditUser').on('hidden.bs.modal', function () {
    $('.modalEditUser').find('.modal-content').html('');
});
$('.modalPrivileges').on('hidden.bs.modal', function () {
    $('.modalPrivileges').find('.modal-content').html('');
});
$('.modalDeleteUser').on('hidden.bs.modal', function () {
    $('.modalDeleteUser').find('.modal-content').html('');
});

/*
===============================================================
=============================MODAL=============================
===============================================================
*/

// when create user form open
$('.modalCreateUser').on('shown.bs.modal', function () {
    // initialize form with parsley validation
    $('form.createUserForm').parsley().on('form:submit', function () {
        // execute ajax request when parsley form submitted
        $.ajax({
            type: 'post',
            url: 'users/ajax_create',
            data: $('form.createUserForm').serialize(),
            cache: false,
            success: function (data) {
                // checking new user data, if exist then reset form, refresh table
                if (data.id) {
                    // reset form => value('')
                    $('form.createUserForm')[0].reset();
                    $('.modalCreateUser').modal('hide');
                    getUsersTable();
                    var PNtitle = 'Success';
                    var PNtext = 'New user account has been created';
                    var PNtype = 'success';
                }
                else {
                    var PNtitle = 'Failed';
                    var PNtext = 'Please make sure NIM/NIP and email are unique';
                    var PNtype = 'warning';
                }
                // create new pnotify object
                new PNotify({
                    title: PNtitle,
                    text: PNtext,
                    type: PNtype,
                });
            }
        });
        return false;
    });
});

// binding after modal edit shown
$('.modalEditUser').on('shown.bs.modal', function (e) {
    // get user id in button component
    var userId = $(e.relatedTarget).data('user-id');
    $.ajax({
        type: 'get',
        url: 'users/ajax_edit',
        cache: false,
        data: {
            user_id: userId,
        },
        beforeSend: function () {
            $('.modalEditUser').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('.modalEditUser').find('.modal-content').html(data);
            afterGetUserModal();
        }
    });
});

// binding after modal delete shown
$('.modalPrivileges').on('shown.bs.modal', function (e) {
    // get user id in button component
    var userId = $(e.relatedTarget).data('user-id');
    $.ajax({
        type: 'get',
        url: 'users/ajax_privileges',
        cache: false,
        data: {
            user_id: userId,
        },
        beforeSend: function () {
            $('.modalPrivileges').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('.modalPrivileges').find('.modal-content').html(data);
            afterPrivilegesModal();
        }
    });
});

// binding after modal delete shown
$('.modalDeleteUser').on('shown.bs.modal', function (e) {
    // get user id in button component
    var userId = $(e.relatedTarget).data('user-id');
    $.ajax({
        type: 'get',
        url: 'users/ajax_delete',
        cache: false,
        data: {
            user_id: userId,
        },
        beforeSend: function () {
            $('.modalDeleteUser').find('.modal-content').html(divSpinner);
        },
        error: function () {
            alert('There is an error when getting data.');
        },
        success: function (data) {
            $('.modalDeleteUser').find('.modal-content').html(data);
            afterDeleteUsersModal();
        }
    });
});
