<?php
/*
 * Reliant on bootstrap and font-awesome css files
 * */
function getHeader()
{
    echo <<< _END
<nav class="navbar navbar-dark navbar-fixed-top bg-inverse">
    <a class="navbar-brand" href="#">
        <i class="fa fa-home"></i> Propman
    </a>

    <form class="pull-xs-left">
        <input type="text" class="form-control search-bar" placeholder="Search...">
    </form>
    <div class="pull-xs-right navbar-icon-set">
        <a class="btn btn-default navbar-icon search-icon" href="#"><i class="fa fa-search"></i></a>
        <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-plus"></i></a>
        <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-user"></i></a>
        <a class="btn btn-default navbar-icon" href="#"><i class="fa fa-bell"></i></a>
    </div>
</nav>
_END;
}
