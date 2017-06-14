<h1>All members</h1>
<p>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <td><b>Photo</b></td>
            <td><b>Name and Surname</b></td>
            <td><b>Report Subject</b></td>
            <td><b>Email</b></td>
        </tr>
            <?php
                foreach($data as $row)
                {
                    if ($row['photo']!=null){
                        $photo = $row['photo'];
                    }else{
                        $photo = "./images/unknown.jpg";
                    };
                    echo '<tr>                
                            <td><img src ="'.$photo.'" alt = "#" width = "75px"></td>
                            <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                            <td>'.$row['report'].'</td>
                            <td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>
                          </tr>';
                }
            ?>
    </table>
</div>
</p>