<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <h2 class="mb-4 fs-3">New product</h2>

    <form action="<?= route("categories.store")?>" method="post">
        <?= csrf_field()?>
        
        <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="ProductName">
        <label for="name">category Name</label>
        </div>

        {{-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="slug" name="slug" placeholder="URL Slug">
        <label for="slug">URL Slug</label>
        </div> --}}

        <button type="submit" class="btn btn-success">SAVE</button>

    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

</html>
