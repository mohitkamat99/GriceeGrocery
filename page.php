<ul>
  <li><a href="?<?php if (isset($_GET['name'])) {
   echo"name=" .$_GET['name'];  }?>&pageno=1">First</a></li>
  <li class="<?php if ($pageno <= 1) {
          echo 'disabled';
        } ?>">
    <a href="<?php if ($pageno <= 1) {
            echo '#';
          } elseif(isset($_GET['name'])) {
              // code...
              echo "?name=".$_GET['name']."&pageno=" . ($pageno - 1);


          }else {
            // code...
              echo "?pageno=" . ($pageno - 1);
          } ?>">Prev</a>
  </li>
  <li class="<?php if ($pageno >= $total_pages) {
          echo 'disabled';
        } ?>">
    <a href="<?php if ($pageno >= $total_pages) {
            echo '#';
          } elseif(isset($_GET['name'])) {
            echo "?name=".$_GET['name']."&pageno=" . ($pageno + 1);
          }else {
            // code...
              echo "?pageno=" . ($pageno + 1);
          } ?>">Next</a>
  </li>
  <li><a href="?<?php if (isset($_GET['name'])) {
   echo "name=" .$_GET['name'];  }?>&pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
