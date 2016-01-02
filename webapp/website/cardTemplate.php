<?php

function displayCard($title, $details, $extraInfo1, $extraInfo2, $extraInfo3)
{
    echo <<< _END
<div class="card-holder col-md-3">
    <div class="card">
      <div class="card-block">
        <h4 class="card-title">$title</h4>
      </div>
      <img class="card-img-top" data-src="holder.js/100%x180/?text=Image cap" alt="Card image cap" src="property.jpg">
      <div class="card-block">
        <p class="card-text">$details</p>
      </div>
_END;
    if ($extraInfo1 || $extraInfo2 || $extraInfo3) {
        echo '  <ul class="list-group list-group-flush">';
        if ($extraInfo1)
            echo '    <li class="list-group-item">' . $extraInfo1 . '</li>';
        if ($extraInfo2)
            echo '    <li class="list-group-item">' . $extraInfo2 . '</li>';
        if ($extraInfo3)
            echo '    <li class="list-group-item">' . $extraInfo3 . '</li>';
        echo "</ul>";
    }
    echo <<< _END
    </div> <!-- card -->
</div> <!-- card-holder -->
_END;
}
