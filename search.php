<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inline</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7" style="justify-content: center;">
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>title</th>
                                    <th>body</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $connect = pg_connect('host=localhost port=5432 dbname=inlinedatabase user=postgres password=...');
                                    if(isset($_GET['search'])){
                                        $search = $_GET['search'];
                                        if (strlen($search)>2){
                                            $query = "SELECT posts.title, comments.body FROM posts, comments WHERE posts.id=comments.postid AND comments.body LIKE '%$search%'";
                                            $query_run = pg_query($connect, $query);
                                            $query_result = pg_fetch_all($query_run);
                                            foreach($query_result as $items){
                                                ?>
                                                <tr>
                                                    <td><?= $items['title']; ?></td>
                                                    <td><?= $items['body']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td colspan="2">No record found</td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>