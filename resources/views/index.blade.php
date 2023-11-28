<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container-fluid">
        <h2>Products</h2>

        {{-- Filter --}}

        <form class="row g-3">
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden">Category</label>
                <select class="form-control" name="category">
                    <option value="" selected>Filter by Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}"
                            {{ $category == $selectedCategory ? 'selected' : '' }}>{{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">Search</label>
                <input type="text" class="form-control" name="q" placeholder="Search..." value="{{ $searchQuery }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Apply</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Images</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Discount %</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td><img src="{{ $item['thirdImage'] }}" alt="No data found" class="img-thumbnail"
                                    width="50"></td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['discountPercentage'] }}</td>
                            <td>{{ $item['brand'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td>{{ $item['stock'] }}</td>
                            <td>{{ $item['rating'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-felx justify-content-center">
            {{ $data->links() }}
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
