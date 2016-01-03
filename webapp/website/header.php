<?php
/*
 * Reliant on bootstrap and font-awesome css files
 * */
function getHeader()
{
    get_plus_modal();
    echo <<<_END
    <nav class="navbar navbar-dark navbar-fixed-top bg-inverse">
    <a class="navbar-brand" href="' . get_url_home() . '">
        <i class="fa fa-home"></i> Propman
    </a>
    <form class="pull-xs-left">
        <input type="text" class="form-control search-bar" placeholder="Search...">
    </form>
    <div class="pull-xs-right navbar-icon-set">
        <button type="button" class="btn btn-default navbar-icon search-icon">
            <i class="fa fa-search"></i>
        </button>
        <button type="button" class="btn btn-default navbar-icon" data-toggle="modal" data-target="#plusModal">
            <i class="fa fa-plus"></i>
        </button>
        <button type="button" class="btn btn-default navbar-icon">
            <i class="fa fa-user"></i>
        </button>
        <button type="button" class="btn btn-default navbar-icon">
            <i class="fa fa-bell"></i>
        </button>
    </div>
</nav>
_END;
}

function get_url_home()
{
    return "/PropertyManager/webapp/website";
//    return sprintf("%s://%s%s",
//        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
//        $_SERVER['SERVER_NAME'],
//        $_SERVER['REQUEST_URI']
//    );
}

function get_url($path)
{
    return get_url_home() . '/' . $path;
}

function get_plus_modal()
{
    echo <<< _END
<div class="modal fade" id="plusModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
          <ul class="nav nav-tabs nav-justified" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#newProperty"><i class="fa fa-plus"></i> Property</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#newTenancy"><i class="fa fa-plus"></i> Tenancy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#newPerson"><i class="fa fa-plus"></i> Person</a>
              </li>
            </ul>
        </div>

        <div class="modal-body">
            <div class="tab-content">
_END;
    echo '<div class="tab-pane active" id="newProperty" role="tabpanel">';
    require_once "../forms/addProperty.php";
    echo '</div>';
    echo '<div class="tab-pane" id="newTenancy" role="tabpanel">';
    echo "Add tenancy form coming soon."; // TODO Create New Tenancy form
    echo '</div>';
    echo '<div class="tab-pane" id="newPerson" role="tabpanel">';
    require_once "../forms/addPerson.php";
    echo '</div>';
    echo <<< _END
            </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-default pull-right" data-dismiss="modal"><i class="fa fa-floppy-o"></i> Save</button>
          <button type="submit" class="btn btn-danger btn-default pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
        </div> <!-- footer -->

      </div> <!-- content -->
    </div> <!-- dialog -->
  </div> <!-- modal -->
_END;
}