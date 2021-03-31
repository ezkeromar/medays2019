<?php

return [

    // Titles
    'showing-all-users'     => 'Afficher tous les utilisateurs',
    'users-menu-alt'        => 'Afficher le menu de gestion des utilisateurs',
    'create-new-user'       => 'Créer un nouvel utilisateur',
    'show-deleted-users'    => "Afficher l'utilisateur supprimé",
    'editing-user'          => "Modification de l'utilisateur :name",
    'showing-user'          => "Affichage de l'utilisateur :name",
    'showing-user-title'    => 'Information du :name',

    // Messages Flash
    'createSuccess'   => 'Membre créé ! ',
    'updateSuccess'   => 'Membre modifié ! ',
    'deleteSuccess'   => 'Membre supprimé ! ',
    'deleteSelfError' => 'Vous ne pouvez pas vous supprimer ! ',

    // Onglet utilisateur
    'viewProfile'            => 'Voir le profil',
    'editUser'               => 'Modifier le membre',
    'deleteUser'             => 'Supprimer le membre',
    'usersBackBtn'           => 'Retour à l liste des membres',
    'usersPanelTitle'        => 'Information du membre',
    'labelUserName'          => 'Pseudo:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'Prénom :',
    'labelLastName'          => 'Nom :',
    'labelRole'              => 'Rôle :',
    'labelStatus'            => 'Etat :',
    'labelAccessLevel'       => 'Accès :',
    'labelPermissions'       => 'Permissions :',
    'labelCreatedAt'         => 'Créé le :',
    'labelUpdatedAt'         => 'Modifié le :',
    'labelIpEmail'           => 'IP connexion par mail :',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'IP connexion réseau social :',
    'labelIpAdmin'           => 'IP connexion admin :',
    'labelIpUpdate'          => 'Dernière IP :',
    'labelDeletedAt'         => 'Supprimer on',
    'labelIpDeleted'         => 'Supprimer IP :',
    'usersDeletedPanelTitle' => 'Supprimer les infos du membre',
    'usersBackDelBtn'        => 'Retour aux membres supprimés',

    'successRestore'    => 'Membre récupéré.',
    'successDestroy'    => 'Enregistrement du membre supprimé.',
    'errorUserNotFound' => 'Membre introuvable.',

    'labelUserLevel'  => 'Niveau',
    'labelUserLevels' => 'Niveaux',

    'users-table' => [
        'caption'   => '{1} :userscount user total|[2,*] :userscount total users',
        'id'        => 'ID',
        'name'      => 'Username',
        'fname'     => 'First Name',
        'lname'     => 'Last Name',
        'email'     => 'Email',
        'role'      => 'Role',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
        'updated'   => 'Updated',
    ],

    'buttons' => [
        'create-new'    => 'New User',
        'delete'        => 'Supprimer',
        'show'          => 'Afficher',
        'edit'          => 'Modifier',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Users</span>',
        'back-to-user'  => 'Back  <span class="hidden-xs">to User</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> User</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> User</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New User',
        'back-users'    => 'Back to users',
        'email-user'    => 'Email :user',
        'submit-search' => 'Submit Users Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'user-creation-success'  => 'Successfully created user!',
        'update-user-success'    => 'Successfully updated user!',
        'delete-success'         => 'Successfully deleted the user!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-user' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'User Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'User Role',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Users',
    ],

    'modals' => [
        'delete_user_message' => 'Are you sure you want to delete :user?',
    ],
];
