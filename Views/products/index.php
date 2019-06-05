<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Products list</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-success">Products list</div>
                <div class="card-body">
                    <table border="1" class="table table-striped table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Image</th>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Avg.</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php 
                while ($row = mysqli_fetch_array($data)){
            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $row["image"];?>" 
                                         width="60px" height="60px" alt="Picture" 
                                         class="img-fluid"/>
                                </td>
                                <td>
                                    <a href="<?php echo URL; ?>index.php?url=products/view/<?php echo $row['id']; ?>"><?php echo $row["name"];?></a>
                                </td>
                                <td class="text-right"><?php echo $row["price"];?></td>
                                <td class="text-center"><?php echo '*'?></td>
                                <td class="text-center">
                                    <a href="<?php echo URL; ?>index.php?url=products/edit/<?php echo $row['id']; ?>" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <a href="<?php echo URL; ?>index.php?url=products/remove/<?php echo $row['id']; ?>" class="btn btn-danger" >
                                        Delete
                                    </a>
                                </td>
                            </tr>
            <?php 
                }
            ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
        
