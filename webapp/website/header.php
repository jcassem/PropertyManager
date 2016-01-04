<?php
/*
 * Reliant on bootstrap and font-awesome css files
 * */
function getHeader()
{
    get_plus_modal();
    get_login_modal();
    get_notification_panel();
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
        <button type="button" class="btn btn-default navbar-icon" data-toggle="modal" data-target="#loginModal">
            <i class="fa fa-user"></i>
        </button>
        <button type="button" class="btn btn-default navbar-icon" data-toggle="dropdown" data-target="#notification-panel">
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
          <button type="submit" class="btn btn-danger btn-default pull-right plus-modal-cancel" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
          <button type="submit" class="btn btn-success btn-default pull-right plus-modal-submit" data-dismiss="modal"><i class="fa fa-floppy-o"></i> Save</button>
        </div> <!-- footer -->

      </div> <!-- content -->
    </div> <!-- dialog -->
  </div> <!-- modal -->
_END;
}

function get_login_modal()
{
    echo <<<_END
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><i class="fa fa-lock"></i> Login</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="username"><i class="fa fa-user"></i> Username</label>
              <input type="text" class="form-control" id="username" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><i class="fa fa-key"></i> Password</label>
              <input type="text" class="form-control" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked> Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p><a href="#">Forgot Password?</a></p>
        </div> <!-- footer -->
      </div> <!-- content -->
    </div> <!-- dialog -->
  </div> <!-- modal -->
_END;
}

function get_notification_panel()
{
    echo <<<_END
<div class="dropdown pull-right" id="notification-panel">
  <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
    <div class="notification-heading">
        <h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right">View all <i class="fa fa-arrow-circle-o-right"></i></h4>
    </div>
    <li class="divider"></li>
   <div class="notifications-wrapper">
     <a class="content" href="#">
       <div class="notification-item">
        <h4 class="item-title">New tenancy created · 1 day ago</h4>
        <p class="item-info">123 Fake Street tenancy</p>
      </div>
    </a>
     <a class="content" href="#">
      <div class="notification-item">
        <h4 class="item-title">New Tenant added · 2 day ago</h4>
        <p class="item-info">Jane Tennot</p>
      </div>
    </a>
     <a class="content" href="#">
      <div class="notification-item">
        <h4 class="item-title">New Property added • 3 day ago</h4>
        <p class="item-info">123 Fake Street</p>
      </div>
    </a>
     <a class="content" href="#">
      <div class="notification-item">
        <h4 class="item-title">New Landlord added • 3 day ago</h4>
        <p class="item-info">Joe Landlord</p>
      </div>
    </a>
   </div>
  </ul>
</div>
_END;
}