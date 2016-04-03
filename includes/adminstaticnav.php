<br/>
<ul class="clsUnorderedBody">
  <?php if (basename($_SERVER['PHP_SELF']) != 'new_section.php') echo '<li><a href="new_section.php">+ Add a new Section</a></li>'; ?>
  <?php if (basename($_SERVER['PHP_SELF']) != 'new_user.php') echo '<li><a href="new_user.php">+ Add a new Admin User</a></li>'; ?>
  <li><a href="logout.php">Logout</a></li>
</ul>
