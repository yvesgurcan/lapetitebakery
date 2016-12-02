<head>
    <style>
        /* small hack to prevent phpversion to change the color of the navbars */
        .navbar, .navbar :not(.glyphicon):not(.logout), .dropdown-menu * {
            background: rgb(35,35,35);
        }
        
        .logout {
            background: rgb(225,75,75);
        }
        
    </style>
</head>
<?=phpinfo()?>