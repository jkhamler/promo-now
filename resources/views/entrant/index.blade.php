<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- PromoNow CSS (Compiled with WebPack) -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <title>@yield('title')</title>
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <div class="col-3">

        </div>

        <div class="col-6">
            <h1 class="text-center">Entrant Homepage</h1>


            <form method="POST" action="{{ route('submitEntry') }}">

                @csrf

                <div class="form-group">
                    <label for="description">URN</label>
                    <input type="text" class="form-control" id="urn" name="urn" required
                           placeholder="Please enter your URN e.g. 'ABC123'">
                </div>

                <div class="form-group">
                    <label for="description">Email</label>
                    <input type="text" class="form-control" id="email" name="email" required
                           placeholder="Please enter your Email address e.g. 'jon@email.com'">
                </div>

                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required
                           placeholder="E.g. 'John'">
                </div>

                <div class="form-group">
                    <label for="firstName">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" required
                           placeholder="E.g. 'Smith'">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <br/>

            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".log-support-ticket-modal">Log Support Ticket</button>
        </div>

        <div class="col-3">

        </div>


    </div>

</div>




<!-- Modal -->
<div class="modal fade log-support-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="container-fluid p-3">

                <h2>Log Support Ticket</h2>

                <form method="POST" action="{{ route('logSupportTicket') }}">

                    <div class="form-group">
                        <label for="description">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Please enter your Email address e.g. 'jon@email.com'">
                    </div>

                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName"
                               placeholder="E.g. 'John'">
                    </div>

                    <div class="form-group">
                        <label for="firstName">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname"
                               placeholder="E.g. 'Smith'">
                    </div>



                    <div class="form-group">
                        <label for="issue">Issue</label>
                        <textarea class="form-control" rows="4" id="issue" name="issue"
                                  placeholder="Please describe the issue that you're having as fully as possible."></textarea>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>

</div>


</body>
</html>