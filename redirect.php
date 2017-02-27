<?php if(empty($_SESSION['userid'])){ ?>
<script>alert('Session Expired');</script>
<script>window.location.href = './Transit_login.php';</script>
<?php }?>