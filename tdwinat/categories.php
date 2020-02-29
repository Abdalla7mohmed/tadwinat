<?php
  session_start();
    include('include/connection.php');
    include('include/header.php');

    $cName = $_POST['category'];
    $cAdd    = $_POST['add'];

    $id = $_GET['id'];
        // التأكد من وجود ال سيشن
    if(!isset($_SESSION['id'])){
      echo "<div class='alert alert-danger'>" . "غير مسموح لك فتح هذه الصفحة" . "</div";
      header('REFRESH:2;URL=login.php');
    }
    else{


?>

<!-- Start Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>لوحة التحكم</h4>
                    <ul>
                        <li>
                            <a href="">
                                <span><i class="fas fa-tags"></i></span>
                                <span>التصنيفات</span>
                            </a>
                        </li>
                        <!-- Articles -->
                        <li data-toggle="collapse" data-target="#menu">
                            <a href="#">
                                <span><i class="far fa-newspaper"></i></span>
                                <span>المقالات</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu">
                            <li>
                                <a href="new-post.php">
                                    <span><i class="far fa-edit"></i></span>
                                    <span>مقال جديد</span>
                                </a>
                            </li>
                            <li>
                                <a href="posts.php">
                                    <span><i class="fas fa-th-large"></i></span>
                                    <span>كل المقالات</span>
                                </a>
                            </li>
                        </ul>
                        <li>
                            <a href="index.php" target="_blank">
                                <span><i class="fas fa-window-restore"></i></span>
                                <span>عرض الموقع</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i></span>
                                <span>تسجيل الخروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-area">
                    <div class="add-category">
                      <?php
                          if(isset($cAdd)){
                              if(empty($cName)){
                                  echo "<div class='alert alert-danger'>" . "حقل التصنيف فارغ" . "</div>";
                              }
                              elseif($cName > 100){
                                  echo "<div class='alert alert-danger'>" . "اسم التصنيف كبير جداً" . "</div>";
                              }
                              else{
                                  $query = "INSERT INTO categories(categoryName) VALUES('$cName')";
                                  mysqli_query($con, $query);
                                  echo "<div class='alert alert-success'>"  . "تمت إضافة التصنيف" . "</div>";
                              }
                          }
                           ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label for="category">تصنيف جديد</label>
                                <input type="text" name="category" class="form-control">
                            </div>
                            <button class="btn-custom" name="add">إضافة</button>
                        </form>
                    </div>

                    <!-- Display Categories -->
                    <div class="display-data mt-5">
                        <?php
                        if(isset($id)){
                          $query = "DELETE FROM categories WHERE id = '$id'";
                           $delete = mysqli_query($con,$query);

                            if(isset($delete)){
                              echo "<div class='alert alert-success'>" . "تم حذف التصنيف بنجاح" . "</div>";
                            }
                            else{
                              echo "<div class='alert alert-danger'>" . "عفواً حدث خطأ ما" . "</div>";
                            }
                        }
                         ?>
                        <table class="table table-borderd">
                            <tr>
                                <th>رقم الفئة</th>
                                <th>إسم الفئة</th>
                                <th>تاريخ الإضافة</th>
                                <th>حذف التصنيف</th>
                            </tr>
                            <?php
                                $query = "SELECT * FROM categories ORDER BY id DESC";
                                $res = mysqli_query($con,$query);
                                $no = 0;
                                while($row = mysqli_fetch_assoc($res )){
                                    $no++;
                                    ?>

                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['categoryName']; ?></td>
                                        <td><?php echo $row['categoryDate']; ?></td>
                                        <td><a href="categories.php?id=<?php echo $row['id']; ?>"><button class="custom-btn">حذف التصنيف</button></a></td>
                                    </tr>

                                  <?php
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Content -->
<?php
}
 ?>
<?php
    include('include/footer.php');
?>
