<?php 

$_con = mysqli_connect("localhost","example","abc123","example");
$sql ="SELECT * FROM `ex_works`";
$query = mysqli_query($_con, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <?php if(isset($_GET['result'])&&$_GET['result']=="success"){echo "<h3>新增成功!</h3>";} ?>
  <?php if(isset($_GET['result'])&&$_GET['result']=="failed"){echo "<h3>新增失敗</h3>";} ?>
  <?php if(isset($_GET['result'])&&$_GET['result']=="nofile"){echo "<h3>未選擇檔案</h3>";} ?>
  <div class="card p-3 mt-3">
    <h2>作品列表</h2>
    <table class="table-striped">
        <thead>
            <tr>
                <td>作品分類</td>
                <td>作品名稱</td>
                <td>年分</td>
                <td>材質</td>
                <td>尺寸</td>
                <td>收藏狀態</td>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query)){ ?>
              <tr>
                <td><?php echo $row['wocategory'];?></td>
                <td><a href=""><?php echo $row['wotitle'];?></a></td>
                <td><?php echo $row['woyear'];?></td>
                <td><?php echo $row['womaterial'];?></td>
                <td><?php echo $row['wosize'];?></td>
                <td><?php echo $row['wostatus'];?></td> 
              </tr>                    
            <?php } ?>
        </tbody>
    </table>
  </div>
  <div class="card p-3 mt-3">
    <h2>新增作品</h2>
    <hr>
    <form action="process.php" method="POST" enctype="multipart/form-data">
      <label for="">作品分類</label>
      <select name="wocategory" id="wocategory" class="form-control">
        <option value="分類一">分類一</option>
        <option value="分類二">分類二</option>
        <option value="分類三">分類三</option>
      </select>
      <label>作品名稱</label>
      <input type="text" name="wotitle" id="wotitle" class="form-control" required>
      <label>年分</label>
      <input type="text" name="woyear" id="woyear" class="form-control" required>
      <label>材質</label>
      <input type="text" name="womaterial" id="womaterial" class="form-control" required>
      <label>尺寸</label>
      <input type="text" name="wosize" id="wosize" class="form-control" required>
      <label>收藏狀態</label>
      <input type="text" name="wostatus" id="wostatus" class="form-control" required>
      <label>作品圖片</label>
      <input type="file" name="wofile" id="wofile" class="form-control" required>
      <hr>
      <!-- 表單要做的動作 -->
      <input type="submit" name="action" class="form-control btn-success" value="新增作品">
    </form>
  </div>
  <?php if(isset($_GET['id'])){
   
    $sql ="SELECT * FROM `ex_works` WHERE `woid` = '".$_GET['id']."' ";
    $query = mysqli_query($_con, $sql);
    $row = mysqli_fetch_assoc($query);

  } ?>

  <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel"><?php echo $row['wotitle']; ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
          <button type="button" class="btn btn-primary">下載</button>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script>
  var myModal = new bootstrap.Modal(document.getElementById('viewModal'), {
    keyboard: false
  });
  <?php if(isset($_GET['id'])){ ?>
    myModal.show();
  <?php } ?>
  
</script>
</html>