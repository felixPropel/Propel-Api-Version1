<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    body {
 background-image: url("{{ asset('img/000-HTTP-Error-400.png')}}");
 background-color: #cccccc;
  background-attachment: fixed;
  background-position: center;
}

    .error-404 {
  margin: 0 auto;
  text-align: center;
}
.error-404 .error-code {
  bottom: 60%;
  color: #4686CC;
  font-size: 96px;
  line-height: 100px;
  font-weight: bold;
}
.error-404 .error-desc {
  font-size: 12px;
  color: #647788;
}
.error-404 .m-b-10 {
  margin-bottom: 420px!important;
}
.error-404 .m-b-20 {
  margin-bottom: 20px!important;

}
.error-404 .m-t-20 {
  margin-top: 20px!important;
  display: none;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-top: 544px;
    margin-bottom: 10px;
}
</style>

<div class="error-404">
    <div class="error-code m-b-10 m-t-20">400 Bad Request!!!<i class="fa fa-warning"></i></div>
    <h2 class="font-bold">Oops 400! Go Home and Fly a kite.</h2>

    <div class="error-desc">
        Sorry, but the page you are looking for was either not found or does not exist. <br/>
        API Can be called only with access headers.
        <div><br/>
            <!-- <a class=" login-detail-panel-button btn" href="http://vultus.de/"> -->
            <!-- <a href="/" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Go back to Homepage</a> -->
        </div>
    </div>
</div>