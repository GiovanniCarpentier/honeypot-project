<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <a class="btn btn-info profile" href="{{ route('users.show',Auth::user()->id) }}" data-index="{{ Auth::user()->id }}">Back</a>
    <title>Avatar Upload</title>
    <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        #ItemContainer {
            margin-top: 2em;
            gap: 15px;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            
        }
        img{
            width: auto;
            height: 20em;
        }
        p{
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">Upload your avatar to our avatar wall</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>
        </form>
    </div>

    <div id="ItemContainer">
        @foreach ($files as $file)
        <div>
            <img src="{{ URL::asset($file -> file_path) }}" alt="{{ $file -> file_path }}">
            <p>{{ $file -> name }}</p>
        </div>
        @endforeach
    </div>

</body>
</html>